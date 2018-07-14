<?php
namespace App\Controller;

use App\Entity\File;
use App\Utility\GeneralUtility;

/**
 * FileController
 */
class FileController extends BaseController {

    /**
     * show Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function show($request, $response, $args) {
        // Render view
        return $this->view->render($response, 'file/show.html.twig', array_merge($args, []));
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
                    $extension = strtolower(substr($uploadFileName, strrpos($uploadFileName, '.')));
                    
                    if (in_array($extension, $settings['upload']['whitelist'])) {
                        $uploadFileHashName = GeneralUtility::generateCode(10) . substr(md5($uploadFileName), 0, 10);
                        $upload->moveTo($settings['upload']['path'] . $uploadFileHashName . $extension);
                        
                        $file = new File();
                        $file->setName($uploadFileName)
                            ->setHashName($uploadFileHashName)
                            ->setMimeType($upload->getClientMediaType())
                            ->setSize(intval($upload->getSize()))
                            ->setExtension($extension)
                            ->setUser($user);
                        $this->em->persist($file);
                        $this->em->flush();
                    }
                }
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
        $files = $user->getFiles();
        
        // if current user is owner of file
        if ($files->contains($file)) {
            $public = $file->isPublic();
            $file->setPublic(!$public);
            $this->em->persist($file);
            $this->em->flush();
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
        $files = $user->getFiles();
        
        // if current user is owner of file
        if ($files->contains($file)) {
            unlink($settings['upload']['path'] . $file->getName() . $file->getExtension());
            $this->em->remove($file);
            $this->em->flush();
        }
        
        return $response->withRedirect($this->router->pathFor('user-show-' . $this->currentLocale));
    }
}
