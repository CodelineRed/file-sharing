<?php
namespace App\Controller;

use App\Entity\FileExtension;
use App\Entity\FileType;
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
    public function createAction($request, $response, $args) {
        // Render view
        return $this->view->render($response, 'file-extension/create.html.twig', array_merge($args, [
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
    public function saveCreateAction($request, $response, $args) {
        $extName = $request->getParam('ext_name');
        $fileType = $request->getParam('file_type');
        $extActive = intval($request->getParam('ext_active'));
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        
        if ($request->isPost()) {
            if (is_string($fileType) && is_string($extName)) {
                $fileExtensionSearch = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['name' => $extName]);
                $fileType = $this->em->getRepository('App\Entity\FileType')->findOneBy(['name' => $fileType]);

                // if file extension exists
                if ($fileExtensionSearch instanceof FileExtension) {
                    $this->flash->addMessage('message', LanguageUtility::trans('file-extension-create-m1') . ';' . self::STYLE_DANGER);
                } elseif ($fileType === NULL) {
                    // if file type not exists
                    $this->flash->addMessage('message', LanguageUtility::trans('file-extension-create-m2') . ';' . self::STYLE_DANGER);
                } elseif (!preg_match('/^\.[a-z0-9]{2,4}$/i', $extName)) {
                    // if file extension name doesn't match regex
                    $this->flash->addMessage('message', LanguageUtility::trans('file-extension-create-m3') . ';' . self::STYLE_DANGER);
                } else {
                    $newFileExtension = new FileExtension();
                    $newFileExtension->setName($extName)
                        ->setHidden(!$extActive)
                        ->setFileType($fileType);
                    $this->em->persist($newFileExtension);
                    $this->em->flush();
                    $this->flash->addMessage('message', LanguageUtility::trans('file-extension-create-m4', [$extName]) . ';' . self::STYLE_SUCCESS);
                    $this->logger->info("User '" . $user->getName() . "' created '" . $extName . "' - FileExtensionController:saveCreate");
                }
            } else {
                $this->flash->addMessage('message', LanguageUtility::trans('file-extension-create-m5') . ';' . self::STYLE_DANGER);
            }
        }
        
        return $response->withRedirect($this->router->pathFor('file-extension-create-' . LanguageUtility::getLocale()));
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
        $fileExtension = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['id' => $args['id']]);
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        
        // if file extension exists
        if ($fileExtension instanceof FileExtension) {
            $hidden = $fileExtension->isHidden();
            $fileExtension->setHidden(!$hidden);
            $this->em->persist($fileExtension);
            $this->em->flush();
            $this->flash->addMessage('message', LanguageUtility::trans('file-extension-hidden-m' . intval($fileExtension->isHidden()), [$fileExtension->getName()]) . ';' . self::STYLE_SUCCESS);
            $this->logger->info("User '" . $user->getName() . "' toggled '" . $fileExtension->getName() . "' to '" . ($fileExtension->isHidden() ? 'locked' : 'unlocked') . "' - FileExtensionController:toggleHidden");
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('file-extension-hidden-m2', [$fileExtension->getName()]) . ';' . self::STYLE_SUCCESS);
        }
        
        return $response->withRedirect($this->router->pathFor('file-extension-show-' . LanguageUtility::getLocale()));
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
        $fileExtension = $this->em->getRepository('App\Entity\FileExtension')->findOneBy(['id' => $args['id']]);
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        
        // if file extension exists
        if ($fileExtension instanceof FileExtension) {
            $this->em->remove($fileExtension);
            $this->em->flush();
            $this->flash->addMessage('message', LanguageUtility::trans('file-extension-remove-m1', [$fileExtension->getName()]) . ';' . self::STYLE_SUCCESS);
            $this->logger->info("User '" . $user->getName() . "' removed '" . $fileExtension->getName() . "' - FileExtensionController:remove");
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('file-extension-remove-m2', [$fileExtension->getName()]) . ';' . self::STYLE_SUCCESS);
        }
        
        return $response->withRedirect($this->router->pathFor('file-extension-show-' . LanguageUtility::getLocale()));
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
        $fileExtensions = $this->em->getRepository('App\Entity\FileExtension')->findAll();
        
        // Render view
        return $this->view->render($response, 'file-extension/show.html.twig', array_merge($args, [
            'fileExtensions' => $fileExtensions,
        ]));
    }
}
