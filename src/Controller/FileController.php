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
    public function downloadAction($request, $response, $args) {
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        // if file exits and not hidden or current user is owner of file
        if ($file instanceof File && !$file->isHidden() || $this->currentUser === $file->getUser()->getId()) {
            if (is_readable($this->settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName())) {
                header("Content-Type: " . $file->getMimeType());
                header("Content-Disposition: attachment; filename=\"" . $file->getName() . "\"");
                flush();
                readfile($this->settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName());
            }
            exit;
        } else {
            return $response->withRedirect($this->router->pathFor('file-show-' . LanguageUtility::getLocale(), $args));
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
    public function showAction($request, $response, $args) {
        $source = $childSource = '';
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        // if file exists and is readable
        if ($file instanceof File && is_readable($this->settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName())) {
            $fileTypeName = $file->getExtension()->getFileType()->getName();
            $source = file_get_contents($this->settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName());
            
            // if file type one of the three
            if (in_array($fileTypeName, ['image', 'audio', 'video'])) {
                // encode file content
                $source = base64_encode($source);
            }
            
            // if file has child file and is readable
            if ($file->getFile() instanceof File && is_readable($this->settings['upload']['path'] . $file->getFile()->getHashName() . $file->getFile()->getExtension()->getName())) {
                // get raw file content
                $childSource = file_get_contents($this->settings['upload']['path'] . $file->getFile()->getHashName() . $file->getFile()->getExtension()->getName());
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
    public function uploadAction($request, $response, $args) {
        if ($request->isPost()) {
            $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
            $files = $request->getUploadedFiles();
            $fileNote = NULL;
            $fileIncluded = (int)$request->getParam('file_included');
            $note = $request->getParam('note');
            
            // if user not logged in
            if ($user === NULL) {
                return $response->withRedirect($this->router->pathFor('page-index-' . LanguageUtility::getGenericLocale()));
            }
            
            // if not empty
            if (!empty($note)) {
                $noteExtension = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['name' => '.txt']);
                $noteFileName = 'note-' . GeneralUtility::generateCode(10) . '.txt';
                $noteHashName = GeneralUtility::generateCode(10) . substr(md5($noteHashName), 0, 10);
                file_put_contents($this->settings['upload']['path'] . $noteHashName . $noteExtension->getName(), $note);
                
                $fileNote = new File();
                $fileNote->setName($noteFileName)
                    ->setHashName($noteHashName)
                    ->setMimeType('text/plain')
                    ->setSize(strlen($note))
                    ->setExtension($noteExtension)
                    ->setHidden(TRUE)
                    ->setUser($user);
            }
            
            // if "upload" exists
            if (isset($files['upload']) && $files['upload'] instanceof \Slim\Http\UploadedFile) {
                $upload = $files['upload'];
                
                // if upload is ok
                if ($upload->getError() === UPLOAD_ERR_OK) {
                    $uploadFileName = $upload->getClientFilename();
                    $extension = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['name' => strtolower(substr($uploadFileName, strrpos($uploadFileName, '.'))), 'hidden' => 0]);
                    
                    // if file extension is allowed and user exists
                    if ($extension instanceof FileExtension && $user instanceof User) {
                        $uploadFileHashName = GeneralUtility::generateCode(10) . substr(md5($uploadFileName), 0, 10);
                        $upload->moveTo($this->settings['upload']['path'] . $uploadFileHashName . $extension->getName());
                        
                        $file = new File();
                        $file->setName($uploadFileName)
                            ->setHashName($uploadFileHashName)
                            ->setMimeType($upload->getClientMediaType())
                            ->setSize(intval($upload->getSize()))
                            ->setExtension($extension)
                            ->setHidden(TRUE)
                            ->setUser($user);
                        
                        // if file note exists
                        if ($fileNote instanceof File) {
                            if ($fileIncluded) {
                                $file->setFile($fileNote);
//                                $fileNote->setFile($file);
                                $fileNote->setFileIncluded(TRUE);
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
                    // if file note exists and not included to a parent file
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
        
        return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale()));
    }
    
    /**
     * toggleHidden Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function toggleHiddenAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        if ($user instanceof User) {
            $files = $user->getFiles();

            // if current user is owner of file or role can edit file other
            if ($files->contains($file) || $this->acl->isAllowed($this->currentRole, 'edit_file_other')) {
                $hidden = $file->isHidden();
                $file->setHidden(!$hidden);
                $this->em->persist($file);
                $this->em->flush();
                
                // if owner of file not requested user
                if ($file->getUser()->getId() !== $user->getId()) {
                    // stay on site from owner of file
                    $args['name'] = $file->getUser()->getName();
                }
                
                $this->flash->addMessage('message', LanguageUtility::trans('file-hidden-m' . intval($hidden), [
                    $file->getName(),
                    $this->router->pathFor('file-show-' . LanguageUtility::getLocale(), $args)
                ]) . ';' . self::STYLE_SUCCESS);
            } else {
                $this->flash->addMessage('message', LanguageUtility::trans('file-hidden-m2', [$file->getName()]) . ';' . self::STYLE_DANGER);
            }
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('file-hidden-m3') . ';' . self::STYLE_DANGER);
        }
        
        return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale(), $args));
    }
    
    /**
     * remove Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function removeAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        if ($user instanceof User) {
            $files = $user->getFiles();

            // if current user is owner of file or role can delete file other
            if ($files->contains($file) || $this->acl->isAllowed($this->currentRole, 'delete_file_other')) {
                $childFile = $file->getFile();
                $this->em->remove($file);
                $this->em->flush();
                
                // if file exists
                if (file_exists($this->settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName())) {
                    unlink($this->settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName());
                }
                
                // if owner of file not requested user
                if ($file->getUser()->getId() !== $user->getId()) {
                    // stay on site from owner of file
                    $args['name'] = $file->getUser()->getName();
                }
                
                // if child file exists
                if ($childFile instanceof File) {
                    $this->flash->addMessage('message', LanguageUtility::trans('file-remove-m1', [$childFile->getName()]) . ';' . self::STYLE_SUCCESS);
                
                    // if file exists
                    if (file_exists($this->settings['upload']['path'] . $childFile->getHashName() . $childFile->getExtension()->getName())) {
                        unlink($this->settings['upload']['path'] . $childFile->getHashName() . $childFile->getExtension()->getName());
                    }
                }
                
                $this->flash->addMessage('message', LanguageUtility::trans('file-remove-m1', [$file->getName()]) . ';' . self::STYLE_SUCCESS);
            } else {
                $this->flash->addMessage('message', LanguageUtility::trans('file-remove-m2', [$file->getName()]) . ';' . self::STYLE_DANGER);
            }
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('file-remove-m3') . ';' . self::STYLE_DANGER);
        }
        
        return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale(), $args));
    }
}
