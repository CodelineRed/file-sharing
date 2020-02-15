<?php
namespace App\Controller;

use App\Entity\Access;
use App\Entity\File;
use App\Entity\FileFolderJoin;
use App\Entity\Folder;
use App\Entity\User;
use App\Utility\LanguageUtility;

/**
 * ApiController is used for request via ajax
 */
class ApiController extends BaseController {
    
    /**
     * Create folder Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function createFolderAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        
        // if request is xhr and user is logged in
        if ($request->isXhr() && $user instanceof User 
                && strlen($request->getParam('name')) > 2 && (int)$request->getParam('access')) {
            $host = ($request->getServerParam('SERVER_PORT') == '80' ? 'http' : 'https') . '://' . $request->getServerParam('HTTP_HOST');
            $access = $this->em->getRepository('App\Entity\Access')->findOneBy(['id' => (int)$request->getParam('access')]);
            
            $folder = new Folder();
            $folder->setName($request->getParam('name'))
                ->setUser($user)
                ->setHidden(FALSE)
                ->setAccess($access);

            $this->em->persist($folder);
            $this->em->flush();

            return json_encode([
                'result' => TRUE,
                'id' => $folder->getId(),
                'name' => $folder->getName(),
                'access' => $folder->getAccessId(),
                'access_icon' => $access->getIcon(),
                'access_button' => $access->getButton(),
                'created_at' => $folder->getCreatedAt(),
                'link' => $host . $this->router->pathFor('folder-show-' . LanguageUtility::getLocale(), ['uuid' => $folder->getId()]),
                'user_name' => $folder->getUser()->getName(),
                'user_link' => $host . $this->router->pathFor('user-show-' . LanguageUtility::getLocale(), ['name' => $folder->getUser()->getName()]),
            ]);
        }
        
        return json_encode(['result' => FALSE]);
    }
    
    /**
     * Get file Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function getFileAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        // if request is xhr and file exists
        if ($request->isXhr() && $file instanceof File) {
            $host = ($request->getServerParam('SERVER_PORT') == '80' ? 'http' : 'https') . '://' . $request->getServerParam('HTTP_HOST');
            
            // if files is public or shareable 
            // OR logged in user is owner of file 
            // OR logged in user has role 'superasmin'
            if(($file->getAccessId() === 2 || $file->getAccessId() === 3) 
                    || ($user instanceof User && $user->getFiles()->contains($file)) 
                    || $this->currentRole === 'superadmin') {
                $access = $file->getAccess();
                
                return json_encode([
                    'result' => TRUE,
                    'id' => $file->getId(),
                    'name' => $file->getName(),
                    'size' => $file->getSize(),
                    'access' => $file->getAccessId(),
                    'access_icon' => $access->getIcon(),
                    'access_button' => $access->getButton(),
                    'access_list' => $this->em->getRepository('App\Entity\Access')->findAllArray(),
                    'folders' => $file->getFoldersArray(),
                    'created_at' => $file->getCreatedAt(),
                    'link' => $host . $this->router->pathFor('file-show-' . LanguageUtility::getLocale(), ['uuid' => $file->getId()]),
                    'download' => $host . $this->router->pathFor('file-download-' . LanguageUtility::getGenericLocale(), ['uuid' => $file->getId()]),
                    'user_name' => $file->getUser()->getName(),
                    'user_link' => $host . $this->router->pathFor('user-show-' . LanguageUtility::getLocale(), ['name' => $file->getUser()->getName()]),
                ]);
            }
        }
        
        return json_encode(['result' => FALSE]);
    }
    
    /**
     * Get folder Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function getFolderAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $folder = $this->em->getRepository('App\Entity\Folder')->findOneBy(['id' => $args['uuid']]);
        
        // if request is xhr and file exists
        if ($request->isXhr() && $folder instanceof Folder) {
            $host = ($request->getServerParam('SERVER_PORT') == '80' ? 'http' : 'https') . '://' . $request->getServerParam('HTTP_HOST');
            
            // if files is public or shareable 
            // OR logged in user is owner of file 
            // OR logged in user has role 'superasmin'
            if(($folder->getAccessId() === 2 || $folder->getAccessId() === 3) 
                    || ($user instanceof User && $user->getFolders()->contains($folder)) 
                    || $this->currentRole === 'superadmin') {
                $access = $folder->getAccess();
                
                return json_encode([
                    'result' => TRUE,
                    'id' => $folder->getId(),
                    'name' => $folder->getName(),
                    'access' => $folder->getAccessId(),
                    'access_icon' => $access->getIcon(),
                    'access_button' => $access->getButton(),
                    'access_list' => $this->em->getRepository('App\Entity\Access')->findAllArray(),
                    'created_at' => $folder->getCreatedAt(),
                    'link' => $host . $this->router->pathFor('folder-show-' . LanguageUtility::getLocale(), ['uuid' => $folder->getId()]),
                    'user_name' => $folder->getUser()->getName(),
                    'user_link' => $host . $this->router->pathFor('user-show-' . LanguageUtility::getLocale(), ['name' => $folder->getUser()->getName()]),
                ]);
            }
        }
        
        return json_encode(['result' => FALSE]);
    }
    
    /**
     * Get access list Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function getAccessListAction($request, $response, $args) {
        $accessArray = $this->em->getRepository('App\Entity\Access')->findAllArray();
        
        // if request is xhr and $accessArray not empty
        if ($request->isXhr() && count($accessArray)) {
            return json_encode([
                'result' => TRUE,
                'access_list' => $accessArray,
            ]);
        }
        
        return json_encode(['result' => FALSE]);
    }
    
    /**
     * Update file update Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function updateFileAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        // if logged in user is owner of file 
        // OR logged in user has role 'superasmin'
        if ($request->isXhr() && $file instanceof File 
                && ($user instanceof User && $user->getFiles()->contains($file)) 
                || $this->currentRole === 'superadmin') {
            $host = ($request->getServerParam('SERVER_PORT') == '80' ? 'http' : 'https') . '://' . $request->getServerParam('HTTP_HOST');
            $file->setName($request->getParam('name'));
            $file->setAccess($this->em->getRepository('App\Entity\Access')->findOneBy(['id' => (int)$request->getParam('access')]));
            $access = $file->getAccess();
            $folders = $request->getParam('folders');
            
            // remove all folder joins
            $file->getFolderJoins()->forAll(function($key, $entity) {
                $this->em->remove($entity); 
                return true;
            });
            $this->em->flush();
            
            // set folder joins
            if (is_array($folders) && count($folders) > 0) {
                foreach ($folders as $uuid) {
                    $folder = $this->em->getRepository('App\Entity\Folder')->findOneBy(['id' => $uuid]);
                    
                    // if $folder is Folder
                    if ($folder instanceof Folder) {
                        $fileFolderJoin = new FileFolderJoin();
                        $fileFolderJoin->setFile($file)->setFolder($folder);
                        $this->em->persist($fileFolderJoin);
                    }
                }
            }
            $this->em->flush();

            return json_encode([
                'result' => TRUE,
                'id' => $file->getId(),
                'name' => $file->getName(),
                'size' => $file->getSize(),
                'access' => $file->getAccessId(),
                'access_icon' => $access->getIcon(),
                'access_button' => $access->getButton(),
                'access_list' => $this->em->getRepository('App\Entity\Access')->findAllArray(),
                'folders' => $file->getFoldersArray(),
                'created_at' => $file->getCreatedAt(),
                'link' => $host . $this->router->pathFor('file-show-' . LanguageUtility::getLocale(), ['uuid' => $file->getId()]),
                'download' => $host . $this->router->pathFor('file-download-' . LanguageUtility::getGenericLocale(), ['uuid' => $file->getId()]),
                'user_name' => $file->getUser()->getName(),
                'user_link' => $host . $this->router->pathFor('user-show-' . LanguageUtility::getLocale(), ['name' => $file->getUser()->getName()]),
            ]);
        }
        
        return json_encode(['result' => FALSE]);
    }
    
    /**
     * Update folder Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function updateFolderAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $folder = $this->em->getRepository('App\Entity\Folder')->findOneBy(['id' => $args['uuid']]);
        
        // if logged in user is owner of file 
        // OR logged in user has role 'superasmin'
        if ($request->isXhr() && $folder instanceof Folder 
                && ($user instanceof User && $user->getFolders()->contains($folder)) 
                || $this->currentRole === 'superadmin') {
            $host = ($request->getServerParam('SERVER_PORT') == '80' ? 'http' : 'https') . '://' . $request->getServerParam('HTTP_HOST');
            $folder->setName($request->getParam('name'));
            $folder->setAccess($this->em->getRepository('App\Entity\Access')->findOneBy(['id' => (int)$request->getParam('access')]));
            $access = $folder->getAccess();
            $this->em->flush();
            
            return json_encode([
                'result' => TRUE,
                'id' => $folder->getId(),
                'name' => $folder->getName(),
                'access' => $folder->getAccessId(),
                'access_icon' => $access->getIcon(),
                'access_button' => $access->getButton(),
                'created_at' => $folder->getCreatedAt(),
                'link' => $host . $this->router->pathFor('folder-show-' . LanguageUtility::getLocale(), ['uuid' => $folder->getId()]),
                'user_name' => $folder->getUser()->getName(),
                'user_link' => $host . $this->router->pathFor('user-show-' . LanguageUtility::getLocale(), ['name' => $folder->getUser()->getName()]),
            ]);
        }
        
        return json_encode(['result' => FALSE]);
    }
}
