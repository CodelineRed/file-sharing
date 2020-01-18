<?php
namespace App\Controller;

use App\Entity\File;
use App\Entity\User;

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
            
            // if files is public or shareable 
            // OR logged in user is owner of file 
            // OR logged in user has role 'superasmin'
            if(($file->getAccess() === 1 ||$file->getAccess() === 2) 
                    || ($user instanceof User && $user->getFiles()->contains($file)) 
                    || $this->currentRole === 'superadmin') {
                return json_encode([
                    'result' => TRUE,
                    'name' => $file->getName(),
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
