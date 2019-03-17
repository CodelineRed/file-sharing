<?php
namespace App\Controller;

use App\Utility\LanguageUtility;

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
    public function indexAction($request, $response, $args) {
        // if user not logged in
        if ($this->currentUser === NULL) {
            if ($this->settings['active_pages']['login'] === TRUE) {
                return $this->view->render($response, 'user/login.html.twig', array_merge($args, []));
            }
            
            return $this->view->render($response, 'partials/construction.html.twig', array_merge($args, []));
        } else {
            $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
            return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale(), ['name' => $user->getName()]));
        }
        
        // Render view
        return $this->view->render($response, 'page/index.html.twig', array_merge($args, []));
    }
}
