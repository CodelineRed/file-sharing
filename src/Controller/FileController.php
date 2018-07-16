<?php
namespace App\Controller;

use App\Entity\File;
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
        
        if ($file instanceof \App\Entity\File && $file->isPublic() || $file->getUser()->getId() === $this->currentUser) {
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
        $base64Source = '';
        $settings = $this->container->get('settings');
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        $fileTypeName = $file->getExtension()->getFileType()->getName();
        
        if (in_array($fileTypeName, ['image', 'audio', 'video'])) {
            $source = file_get_contents($settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName());
            $base64Source = 'data:' . $file->getMimeType() . ';base64,' . base64_encode($source);
        }
        
        // Render view
        return $this->view->render($response, 'file/show.html.twig', array_merge($args, [
            'file' => $file,
            'base64Source' => $base64Source,
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
            $files = $request->getUploadedFiles();
            $settings = $this->container->get('settings');
            
            if (isset($files['upload']) && $files['upload'] instanceof \Slim\Http\UploadedFile) {
                $upload = $files['upload'];
                
                if ($upload->getError() === UPLOAD_ERR_OK) {
                    $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
                    $uploadFileName = $upload->getClientFilename();
                    $extension = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['name' => strtolower(substr($uploadFileName, strrpos($uploadFileName, '.'))), 'active' => 1]);
                    
                    if ($extension instanceof \App\Entity\FileExtension && $user instanceof \App\Entity\User) {
                        $uploadFileHashName = GeneralUtility::generateCode(10) . substr(md5($uploadFileName), 0, 10);
                        $upload->moveTo($settings['upload']['path'] . $uploadFileHashName . $extension->getName());
                        
                        $file = new File();
                        $file->setName($uploadFileName)
                            ->setHashName($uploadFileHashName)
                            ->setMimeType($upload->getClientMediaType())
                            ->setSize(intval($upload->getSize()))
                            ->setExtension($extension)
                            ->setUser($user);
                        $this->em->persist($file);
                        $this->em->flush();
                        $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m1') . ';' . self::STYLE_SUCCESS);
                    } else {
                        $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m2') . ';' . self::STYLE_DANGER);
                    }
                } else {
                    $this->flash->addMessage('message', LanguageUtility::trans('file-upload-m3', [$upload->getError()]) . ';' . self::STYLE_DANGER);
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
        
        if ($user instanceof \App\Entity\User) {
            $files = $user->getFiles();

            // if current user is owner of file
            if ($files->contains($file)) {
                unlink($settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName());
                $this->em->remove($file);
                $this->em->flush();
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
