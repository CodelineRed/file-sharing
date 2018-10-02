<?php
namespace App\Controller;

use App\Entity\File;
use App\Entity\FileExtension;
use App\Entity\User;
use App\Utility\GeneralUtility;
use App\Utility\LanguageUtility;

/**
 * FileController
 */
class FileController extends BaseController {
    
    /**
     * download Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function download($request, $response, $args) {
        /** @var \App\Entity\File $file **/
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        $settings = $this->container->get('settings');
        
        if ($file instanceof File && $file->isPublic() || $file->getUser()->getId() === $this->currentUser) {
            header("Content-Type: " . $file->getMimeType());
            header("Content-Disposition: attachment; filename=\"" . $file->getName() . "\"");
            flush();
            readfile($settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName());
            exit;
        } else {
            return $response->withRedirect($this->router->pathFor('file-show-' . $this->currentLocale, $args));
        }
        
        // Render view
        return $this->view->render($response, 'file/show.html.twig', array_merge($args, []));
    }

    /**
     * show Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function show($request, $response, $args) {
        $source = $childSource = '';
        $settings = $this->container->get('settings');
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        if ($file instanceof File) {
            $fileTypeName = $file->getExtension()->getFileType()->getName();
            $source = file_get_contents($settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName());

            if (in_array($fileTypeName, ['image', 'audio', 'video'])) {
                $source = base64_encode($source);
            }
            
            if ($file->getFile() instanceof File) {
                $childSource = file_get_contents($settings['upload']['path'] . $file->getFile()->getHashName() . $file->getFile()->getExtension()->getName());
            }
        }
        
        // Render view
        return $this->view->render($response, 'file/show.html.twig', array_merge($args, [
            'file' => $file,
            'source' => $source,
            'childSource' => $childSource,
        ]));
    }
    
    /**
     * Upload Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function upload($request, $response, $args) {
        if ($request->isPost()) {
            $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
            $files = $request->getUploadedFiles();
            $fileNote = NULL;
            $fileIncluded = (int)$request->getParam('file_included');
            $note = $request->getParam('note');
            $proceedFileUpload = TRUE;
            $settings = $this->container->get('settings');
            
            // if not empty
            if (!empty($note)) {
                $noteExtension = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['name' => '.txt']);
                $noteFileName = 'note-' . GeneralUtility::generateCode(10) . '.txt';
                $noteHashName = GeneralUtility::generateCode(10) . substr(md5($noteHashName), 0, 10);
                file_put_contents($settings['upload']['path'] . $noteHashName . $noteExtension->getName(), $note);
                
                $fileNote = new File();
                $fileNote->setName($noteFileName)
                    ->setHashName($noteHashName)
                    ->setMimeType('text/plain')
                    ->setSize(strlen($note))
                    ->setExtension($noteExtension)
                    ->setUser($user);
            }
            
            if (isset($files['upload']) && $files['upload'] instanceof \Slim\Http\UploadedFile && $proceedFileUpload) {
                $upload = $files['upload'];
                
                if ($upload->getError() === UPLOAD_ERR_OK) {
                    $uploadFileName = $upload->getClientFilename();
                    $extension = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['name' => strtolower(substr($uploadFileName, strrpos($uploadFileName, '.'))), 'active' => 1]);
                    
                    if ($extension instanceof FileExtension && $user instanceof User) {
                        $uploadFileHashName = GeneralUtility::generateCode(10) . substr(md5($uploadFileName), 0, 10);
                        $upload->moveTo($settings['upload']['path'] . $uploadFileHashName . $extension->getName());
                        
                        $file = new File();
                        $file->setName($uploadFileName)
                            ->setHashName($uploadFileHashName)
                            ->setMimeType($upload->getClientMediaType())
                            ->setSize(intval($upload->getSize()))
                            ->setExtension($extension)
                            ->setUser($user);
                        
                        if ($fileNote instanceof File) {
                            if ($fileIncluded) {
                                $file->setFile($fileNote);
                                $fileNote->setFile($file)
                                    ->setFileIncluded(TRUE);
                            }
                            
                            $this->em->persist($fileNote);
                            $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m5', [$fileNote->getName()]) . ';' . self::STYLE_SUCCESS);
                        }
                        
                        $this->em->persist($file);
                        $this->em->flush();
                        $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m1', [$file->getName()]) . ';' . self::STYLE_SUCCESS);
                    } else {
                        $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m2') . ';' . self::STYLE_DANGER);
                    }
                } else {
                    if ($fileNote instanceof File && !$fileIncluded) {
                        $this->em->persist($fileNote);
                        $this->em->flush();
                        $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m5', [$fileNote->getName()]) . ';' . self::STYLE_SUCCESS);
                    } else {
                        $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m3', [$upload->getError()]) . ';' . self::STYLE_DANGER);
                    }
                }
            } else {
                $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m4') . ';' . self::STYLE_DANGER);
            }
        }
        
        return $response->withRedirect($this->router->pathFor('user-show-' . $this->currentLocale));
    }
    
    /**
     * togglePublic Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function togglePublic($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        if ($user instanceof \App\Entity\User) {
            $files = $user->getFiles();

            // if current user is owner of file
            if ($files->contains($file)) {
                $public = $file->isPublic();
                $file->setPublic(!$public);
                $this->em->persist($file);
                $this->em->flush();
                $this->flash->addMessage('message', LanguageUtility::trans('file-public-m' . intval($public), [$file->getName()]) . ';' . self::STYLE_SUCCESS);
            } else {
                $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m2') . ';' . self::STYLE_DANGER);
            }
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m3') . ';' . self::STYLE_DANGER);
        }
        
        return $response->withRedirect($this->router->pathFor('user-show-' . $this->currentLocale));
    }
    
    /**
     * remove Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function remove($request, $response, $args) {
        $settings = $this->container->get('settings');
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        if ($user instanceof User) {
            $files = $user->getFiles();

            // if current user is owner of file
            if ($files->contains($file)) {
                $childFile = $file->getFile();
                $file->setFile(NULL);
                $this->em->persist($file);
                
                if ($childFile instanceof File) {
                    $childFile->setFile(NULL);
                    $this->em->persist($childFile);
                }
                $this->em->flush();
                
                if ($childFile instanceof File) {
                    $this->em->remove($childFile);
                    $this->flash->addMessage('message', LanguageUtility::trans('file-remove-m1', [$childFile->getName()]) . ';' . self::STYLE_SUCCESS);
                }
                
                $this->em->remove($file);
                $this->em->flush();
                unlink($settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName());
                $this->flash->addMessage('message', LanguageUtility::trans('file-remove-m1', [$file->getName()]) . ';' . self::STYLE_SUCCESS);
            } else {
                $this->flash->addMessage('message', LanguageUtility::trans('file-remove-m2') . ';' . self::STYLE_DANGER);
            }
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('file-remove-m3') . ';' . self::STYLE_DANGER);
        }
        
        return $response->withRedirect($this->router->pathFor('user-show-' . $this->currentLocale));
    }
}
