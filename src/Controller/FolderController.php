<?php
namespace App\Controller;

use App\Entity\Access;
use App\Entity\Folder;
use App\Entity\User;
use App\Utility\LanguageUtility;

/**
 * FolderController
 */
class FolderController extends BaseController {

    /**
     * show Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function showAction($request, $response, $args) {
        $folder = $this->em->getRepository('App\Entity\Folder')->findOneBy(['id' => $args['uuid']]);
        $files = $publicFiles = [];
        $user = NULL;
        
        // if folder exists
        if ($folder instanceof Folder) {
            $user = $folder->getUser();
            $files = $this->em->getRepository('App\Entity\Folder')->findUniqueFiles($folder);
            $publicFiles = $this->em->getRepository('App\Entity\Folder')->findPublicFiles($folder);
        }
        
        // Render view
        return $this->view->render($response, 'folder/show.html.twig', array_merge($args, [
            'user' => $user,
            'folder' => $folder,
            'files' => $files,
            'publicFiles' => $publicFiles,
        ]));
    }
    
    /**
     * toggleAccess Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function toggleAccessAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $folder = $this->em->getRepository('App\Entity\Folder')->findOneBy(['id' => $args['uuid']]);
        $args['name'] = $user->getName();
        
        if ($user instanceof User) {
            $folders = $user->getFolders();

            // if current user is owner of folder or role can edit folder other
            if ($folders->contains($folder) || $this->acl->isAllowed($this->currentRole, 'update_folder_other')) {
                $accessId = ($folder->getAccessId() + 1) < 4 ? ($folder->getAccessId() + 1) : 1;
                $access = $this->em->getRepository('App\Entity\Access')->findOneBy(['id' => $accessId]);
                
                $folder->setAccess($access);
                $this->em->persist($folder);
                $this->em->flush();
                
                // if owner of folder not requested user
                if ($folder->getUser()->getId() !== $user->getId()) {
                    // stay on site from owner of folder
                    $args['name'] = $folder->getUser()->getName();
                }
                
                $this->flash->addMessage('message', LanguageUtility::trans('folder-access-m' . $folder->getAccessId(), [
                    $folder->getName(),
                    $this->router->pathFor('folder-show-' . LanguageUtility::getLocale(), $args)
                ]) . ';' . self::STYLE_SUCCESS);
                $this->logger->info("User '" . $user->getName() . "' toggled '" . $folder->getName() . "' to '" . ($access instanceof Access ? $access->getName() : 'private') . "' - FolderController:toggleAccess");
            } else {
                $this->flash->addMessage('message', LanguageUtility::trans('folder-access-m4', [$folder->getName()]) . ';' . self::STYLE_DANGER);
            }
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('folder-access-m5') . ';' . self::STYLE_DANGER);
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
        $folder = $this->em->getRepository('App\Entity\Folder')->findOneBy(['id' => $args['uuid']]);
        $args['name'] = $user->getName();
        
        if ($user instanceof User) {
            $folders = $user->getFolders();

            // if current user is owner of folder or role can delete folder other
            if ($folders->contains($folder) || $this->acl->isAllowed($this->currentRole, 'remove_folder_other')) {
                $this->em->remove($folder);
                $this->em->flush();
                
                // if owner of folder not requested user
                if ($folder->getUser()->getId() !== $user->getId()) {
                    // stay on site from owner of folder
                    $args['name'] = $folder->getUser()->getName();
                }
                
                $this->flash->addMessage('message', LanguageUtility::trans('folder-remove-m1', [$folder->getName()]) . ';' . self::STYLE_SUCCESS);
                $this->logger->info("User '" . $user->getName() . "' removed '" . $folder->getName() . "' - FolderController:remove");
            } else {
                $this->flash->addMessage('message', LanguageUtility::trans('folder-remove-m2', [$folder->getName()]) . ';' . self::STYLE_DANGER);
            }
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('folder-remove-m3') . ';' . self::STYLE_DANGER);
        }
        
        return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale(), $args));
    }
}
