<?php
namespace App\Controller;

use App\Entity\File;
use App\Utility\GeneralUtility;

/**
 * FileController
 */
class FileController extends BaseController {

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
                        $uploadFileName = GeneralUtility::generateCode(10) . substr(md5($uploadFileName), 0, 10);
                        $upload->moveTo($settings['upload']['path'] . $uploadFileName . $extension);

                        $file = new File();
                        $file->setName($uploadFileName)
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
}
