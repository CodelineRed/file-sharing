<?php
namespace App\Controller;

use App\Entity\FileExtension;

/**
 * FileController
 */
class FileExtensionController extends BaseController {

    /**
     * create Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function create($request, $response, $args) {
        $extName = $request->getParam('ext_name');
        $fileType = $request->getParam('file_type');
        $extActive = intval($request->getParam('ext_active'));
        $message = 0;
        $alert = '';
        
        if ($request->isPost()) {
            // if is other user and current user is alowed show_user_other
            if (is_string($fileType) && is_string($extName)) {
                $fileExtensionSearch = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['name' => $extName]);
                $fileType = $this->em->getRepository('App\Entity\FileType')->findOneBy(['name' => $fileType]);

                // if file extension exists
                if ($fileExtensionSearch instanceof \App\Entity\FileExtension) {
                    $message = 1;
                    $alert = self::STYLE_DANGER;
                } elseif (!($fileType instanceof \App\Entity\FileType)) {
                    $message = 2;
                    $alert = self::STYLE_DANGER;
                } elseif (!preg_match('/^\.[a-z0-9]{2,4}$/i', $extName)) {
                    $message = 3;
                    $alert = self::STYLE_DANGER;
                } else {
                    $newFileExtension = new FileExtension();
                    $newFileExtension->setName($extName)
                        ->setActive($extActive)
                        ->setFileType($fileType);
                    $this->em->persist($newFileExtension);
                    $this->em->flush();
                    $message = 4;
                    $alert = self::STYLE_SUCCESS;
                }
            } else {
                $message = 5;
                $alert = self::STYLE_DANGER;
            }
        }
        
        // Render view
        return $this->view->render($response, 'file-extension/create.html.twig', array_merge($args, [
            'message' => $message,
            'alert' => $alert,
            'fileTypes' => $this->em->getRepository('App\Entity\FileType')->findAll(),
        ]));
    }
    
    /**
     * toggleActive Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function toggleActive($request, $response, $args) {
        $fileExtension = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['id' => $args['id']]);
        
        if ($fileExtension instanceof \App\Entity\FileExtension) {
            $active = $fileExtension->isActive();
            $fileExtension->setActive(!$active);
            $this->em->persist($fileExtension);
            $this->em->flush();
        }
        
        return $response->withRedirect($this->router->pathFor('file-extension-show-' . $this->currentLocale));
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
        $fileExtension = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['id' => $args['id']]);
        
        if ($fileExtension instanceof \App\Entity\FileExtension) {
            $this->em->remove($fileExtension);
            $this->em->flush();
        }
        
        return $response->withRedirect($this->router->pathFor('file-extension-show-' . $this->currentLocale));
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
        $fileExtensions = $this->em->getRepository('App\Entity\FileExtension')->findAll();
        
        // Render view
        return $this->view->render($response, 'file-extension/show.html.twig', array_merge($args, [
            'fileExtensions' => $fileExtensions,
        ]));
    }
}
