<?php
namespace App\Controller;

/**
 * PageController is used for static pages
 */
class PageController extends BaseController {

    /**
     * Index Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function index($request, $response, $args) {
        // Sample log message
        //$this->logger->info("Slim-Skeleton '/' route");
        
        $users = [];
        
        try {
            $users = $this->em->getRepository('App\Entity\User')->findAll();
        } catch (\Exception $e) {
            // failed to connect
        }

        // Render view
        return $this->view->render($response, 'page/index.html.twig', array_merge($args, 
            [
                'users' => $users,
            ]
        ));
    }

    /**
     * Example Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function example($request, $response, $args) {
        // Render view
        return $this->view->render($response, 'page/example.html.twig', $args);
    }
}
