<?php
namespace App\Controller;

use App\Container\AclRepositoryContainer;
use App\Utility\GeneralUtility;
use App\Utility\LanguageUtility;

/**
 * Base functions for controller
 */
class BaseController {

    const STYLE_DANGER = 'danger';
    const STYLE_SUCCESS = 'success';

    /** @var \Geggleto\Acl\AclRepository $acl **/
    protected $acl;

    /** @var \Doctrine\ORM\EntityManager $em **/
    protected $em;

    /** @var \Slim\Flash\Messages $flash **/
    protected $flash;

    /** @var \Slim\Container $container **/
    protected $container;

    /** @var \Slim\Csrf\Guard $csrf **/
    protected $csrf;

    /** @var string $currentLocale **/
    protected $currentLocale;

    /** @var string $currentRole **/
    protected $currentRole;

    /** @var integer $currentUser **/
    protected $currentUser;

    /** @var \Monolog\Logger $logger **/
    protected $logger;

    /** @var \Slim\Router $router **/
    protected $router;

    /** @var array $settings **/
    protected $settings;

    /** @var \Slim\Views\Twig $view **/
    protected $view;

    /**
     * @param \Slim\Container $container
     */
    public function __construct($container) {
        $this->acl = AclRepositoryContainer::getInstance();
        $this->em = $container->get('em');
        $this->flash = $container->get('flash');
        $this->container = $container;
        $this->csrf = $container->get('csrf');
        $this->currentLocale = strtolower(LanguageUtility::getCurrentLocale());
        $this->currentRole = GeneralUtility::getCurrentRole();
        $this->currentUser = GeneralUtility::getCurrentUser();
        $this->logger = $container->get('logger');
        $this->router = $container->get('router');
        $this->settings = $container->get('settings');
        $this->view = $container->get('view');
    }
}
