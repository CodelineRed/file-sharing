<?php
namespace App\Controller;

use App\Utility\GeneralUtility;
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

    /**
     * System Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function systemAction($request, $response, $args) {
        
        // Render view
        return $this->view->render($response, 'page/system.html.twig', array_merge($args, [
            'fsVersion' => FILE_SHARING_VERSION,
            'phpVersion' => PHP_VERSION,
            'maxFileSize' => GeneralUtility::getUploadMaxFilesize(),
            'maxExecutionTime' => ini_get('max_execution_time'),
            'users' => $this->em->getRepository('App\Entity\User')->findAll(),
            'publicUsers' => $this->em->getRepository('App\Entity\User')->findBy(['hidden' => FALSE]),
            'lockedUsers' => $this->em->getRepository('App\Entity\User')->findBy(['hidden' => TRUE]),
            'tfaUsers' => $this->em->getRepository('App\Entity\User')->findBy(['twoFactor' => TRUE]),
            'recoveryCodes' => $this->em->getRepository('App\Entity\RecoveryCode')->findAll(),
            'roles' => $this->em->getRepository('App\Entity\Role')->findAll(),
            'files' => $this->em->getRepository('App\Entity\File')->findAll(),
            'uniqueFiles' => $this->em->getRepository('App\Entity\File')->findBy(['fileIncluded' => FALSE]),
            'publicFiles' => $this->em->getRepository('App\Entity\File')->findBy(['fileIncluded' => FALSE, 'access' => $this->em->getRepository('App\Entity\Access')->findOneBy(['id' => 3])]),
            'shareableFiles' => $this->em->getRepository('App\Entity\File')->findBy(['fileIncluded' => FALSE, 'access' => $this->em->getRepository('App\Entity\Access')->findOneBy(['id' => 2])]),
            'privateFiles' => $this->em->getRepository('App\Entity\File')->findBy(['fileIncluded' => FALSE, 'access' => $this->em->getRepository('App\Entity\Access')->findOneBy(['id' => 1])]),
            'fileExtensions' => $this->em->getRepository('App\Entity\FileExtension')->findAll(),
            'publicFileExtensions' => $this->em->getRepository('App\Entity\FileExtension')->findBy(['hidden' => FALSE]),
            'lockedFileExtensions' => $this->em->getRepository('App\Entity\FileExtension')->findBy(['hidden' => TRUE]),
            'fileTypes' => $this->em->getRepository('App\Entity\FileType')->findAll(),
        ]));
    }

    /**
     * Log Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function logAction($request, $response, $args) {
        // get all log files in reverse (latest first)
        $logs = array_reverse(glob('../logs/*.log'));
        $rows = [];
        
        foreach ($logs as $log) {
            $logRows = [];
            $handle = fopen($log, 'r');
            
            // read file line by line
            while (($line = fgets($handle)) !== false) {
                $logRows[] = $line;
            }
            
            fclose($handle);
            // reverse line order (latest first)
            $logRows = array_reverse($logRows);
            
            foreach ($logRows as $logRow) {
                // extract information
                if (preg_match('/(\[(.*)\]) ([a-z-]*).(.*): (.*)/', $logRow, $matches) === 1) {
                    $rows[] = [
                        'date' => isset($matches[2]) ? $matches[2] : '',
                        'state' => isset($matches[4]) ? strtolower($matches[4]) : '',
                        'msg' => isset($matches[5]) ? $matches[5] : '',
                    ];
                }
            }
        }
        
        // Render view
        return $this->view->render($response, 'page/log.html.twig', array_merge($args, [
            'fsVersion' => FILE_SHARING_VERSION,
            'logs' => $rows,
        ]));
    }
}
