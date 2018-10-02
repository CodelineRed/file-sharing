<?php
namespace App\Controller;

use App\Entity\FileExtension;
use App\Utility\GeneralUtility;
use App\Utility\LanguageUtility;

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
        // Render view
        return $this->view->render($response, 'file-extension/create.html.twig', array_merge($args, [
            'messages' => GeneralUtility::getFlashMessages(),
            'fileTypes' => $this->em->getRepository('App\Entity\FileType')->findAll(),
        ]));
    }

    /**
     * saveCreate Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function saveCreate($request, $response, $args) {
        $extName = $request->getParam('ext_name');
        $fileType = $request->getParam('file_type');
        $extActive = intval($request->getParam('ext_active'));
        
        if ($request->isPost()) {
            // if is other user and current user is alowed show_user_other
            if (is_string($fileType) && is_string($extName)) {
                $fileExtensionSearch = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['name' => $extName]);
                $fileType = $this->em->getRepository('App\Entity\FileType')->findOneBy(['name' => $fileType]);

                // if file extension exists
                if ($fileExtensionSearch instanceof \App\Entity\FileExtension) {
                    $this->flash->addMessage('message', LanguageUtility::trans('file-extension-create-m1') . ';' . self::STYLE_DANGER);
                } elseif (!($fileType instanceof \App\Entity\FileType)) {
                    $this->flash->addMessage('message', LanguageUtility::trans('file-extension-create-m2') . ';' . self::STYLE_DANGER);
                } elseif (!preg_match('/^\.[a-z0-9]{2,4}$/i', $extName)) {
                    $this->flash->addMessage('message', LanguageUtility::trans('file-extension-create-m3') . ';' . self::STYLE_DANGER);
                } else {
                    $newFileExtension = new FileExtension();
                    $newFileExtension->setName($extName)
                        ->setActive($extActive)
                        ->setFileType($fileType);
                    $this->em->persist($newFileExtension);
                    $this->em->flush();
                    $this->flash->addMessage('message', LanguageUtility::trans('file-extension-create-m4', [$extName]) . ';' . self::STYLE_SUCCESS);
                }
            } else {
                $this->flash->addMessage('message', LanguageUtility::trans('file-extension-create-m5') . ';' . self::STYLE_DANGER);
            }
        }
        
        return $response->withRedirect($this->router->pathFor('file-extension-create-' . $this->currentLocale));
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
            $this->flash->addMessage('message', LanguageUtility::trans('file-extension-active-m' . intval($active), [$fileExtension->getName()]) . ';' . self::STYLE_SUCCESS);
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('file-extension-active-m2', [$fileExtension->getName()]) . ';' . self::STYLE_SUCCESS);
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
            $this->flash->addMessage('message', LanguageUtility::trans('file-extension-remove-m1', [$fileExtension->getName()]) . ';' . self::STYLE_SUCCESS);
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('file-extension-remove-m2', [$fileExtension->getName()]) . ';' . self::STYLE_SUCCESS);
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
            'messages' => GeneralUtility::getFlashMessages(),
        ]));
    }
}
