<?php
namespace App\Controller;

use App\Entity\File;
use App\Entity\User;
use App\Utility\LanguageUtility;

/**
 * ApiController is used for request via ajax
 */
class ApiController extends BaseController {
    
    /**
     * File show Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function fileShowAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        // if request is xhr and file exists
        if ($request->isXhr() && $file instanceof File) {
            $host = ($_SERVER['SERVER_PORT'] == '80' ? 'http' : 'https') . '://' . $_SERVER['HTTP_HOST'];
            
            // if files is public or shareable 
            // OR logged in user is owner of file 
            // OR logged in user has role 'superasmin'
            if(($file->getAccess() === 1 ||$file->getAccess() === 2) 
                    || ($user instanceof User && $user->getFiles()->contains($file)) 
                    || $this->currentRole === 'superadmin') {
                return json_encode([
                    'result' => TRUE,
                    'uuid' => $file->getId(),
                    'name' => $file->getName(),
                    'size' => $file->getSize(),
                    'access' => $file->getAccess(),
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
     * File update Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function fileUpdateAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $file = $this->em->getRepository('App\Entity\File')->findOneBy(['id' => $args['uuid']]);
        
        // if logged in user is owner of file 
        // OR logged in user has role 'superasmin'
        if (($user instanceof User && $user->getFiles()->contains($file)) 
                || $this->currentRole === 'superadmin') {
            $file->setName($request->getParam('name'));

            $this->em->persist($file);
            $this->em->flush();

            return json_encode(['result' => TRUE]);
        }
        
        return json_encode(['result' => FALSE]);
    }
}
