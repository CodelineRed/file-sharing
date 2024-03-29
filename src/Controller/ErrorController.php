<?php
namespace App\Controller;

/**
 * ErrorController is used for error pages
 */
class ErrorController extends BaseController {

    /**
     * Not found Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @return \Slim\Http\Response
     */
    public function notFoundAction($request, $response) {
        // Render view
        $notFoundRoute = (isset($_SESSION['notFoundRoute']) ? $_SESSION['notFoundRoute'] : '');
        $this->logger->warning("Route '" . $notFoundRoute . "' not found - ErrorController:notFound");
        return $this->view->render($response, 'error/not-found.html.twig', [])->withStatus(404);
    }

    /**
     * Not allowed Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function notAllowedAction($request, $response, $args) {
        // Render view
        $notAllowedRoute = (isset($_SESSION['notAllowedRoute']) ? $_SESSION['notAllowedRoute'] : '');
        $allowedMethods = (isset($_SESSION['allowedMethods']) ? $_SESSION['allowedMethods'] : '');
        $this->logger->warning("Route '" . $notAllowedRoute . "' not allowed '" . $notAllowedRoute . "' - ErrorController:notAllowed");
        return $this->view->render($response, 'error/not-allowed.html.twig', [
            'methods' => $allowedMethods,
        ])->withStatus(405)->withHeader('Allow', str_replace('-', ', ', $_SESSION['allowedMethods']));
    }

    /**
     * Unauthorized Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @return \Slim\Http\Response
     */
    public function unauthorizedAction($request, $response) {
        // Render view
        $this->logger->warning("Route '" . $request->getUri()->getPath() . "' unauthorized - ErrorController:unauthorized");
        return $this->view->render($response, 'error/unauthorized.html.twig', [])->withStatus(401);
    }

    /**
     * Bad request Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @return \Slim\Http\Response
     */
    public function badRequestAction($request, $response) {
        // Render view
        $this->logger->warning("Bad request - ErrorController:badRequest");
        return $this->view->render($response, 'error/bad-request.html.twig', [])->withStatus(400);
    }
}
