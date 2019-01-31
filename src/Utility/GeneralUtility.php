<?php
namespace App\Utility;

use App\Container\AppContainer;
use App\Controller\BaseController;

class GeneralUtility {
    
    /**
     * @param string $pass
     * @return type
     */
    static function encryptPassword($pass) {
        $options = [
            'cost' => 11,
            'salt' => random_bytes(22),
        ];
        return password_hash($pass, PASSWORD_BCRYPT, $options);
    }
    
    /**
     * Generates random codes
     * 
     * @param integer $length
     * @return string
     */
    static function generateCode($length = 18) {
        $chars = 'abcdefghijkmnopqrstuvwxyz023456789';
        srand((double)microtime()*1000000);
        $i = 0;
        $code = '' ;

        while ($i <= $length) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $code = $code . $tmp;
            $i++;
        }

        return $code;
    }
    
    /**
     * Returns current user id or NULL if user not logged in.
     * 
     * @return mixed
     */
    static function getCurrentUser() {
        return isset($_SESSION['currentUser']) ? $_SESSION['currentUser'] : NULL;
    }
    
    /**
     * Set the current user
     * 
     * @param integer $currentUser
     */
    static function setCurrentUser($currentUser) {
        $_SESSION['currentUser'] = $currentUser;
    }
    
    /**
     * Returns current role or 'guest' if user not logged in.
     * 
     * @return string
     */
    static function getCurrentRole() {
        return isset($_SESSION['currentRole']) ? $_SESSION['currentRole'] : 'guest';
    }
    
    /**
     * Set the current role
     * 
     * @param string $currentRole
     */
    static function setCurrentRole($currentRole) {
        $_SESSION['currentRole'] = $currentRole;
    }
    
    /**
     * Returns flash message array.
     * 
     * @return array
     */
    static function getFlashMessages() {
        $flash = AppContainer::getInstance()->getContainer()->get('flash');
        $flashMessages = $flash->getMessage('message');
        $messages = [];
        
        if (is_array($flashMessages)) {
            foreach ($flashMessages as $flashMessage) {
                list($text, $style) = explode(';', $flashMessage);
                $messages[] = [
                    'text' => $text,
                    'style' => $style,
                ];
            }
        }
        
        return $messages;
    }
    
    /**
     * Get real user ip
     * 
     * @return string
     */
    static function getUserIP() {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return empty(explode(':', explode(',', $forward)[0])[0]) ? $ip : explode(':', explode(',', $forward)[0])[0];
    }
    
    /**
     * Returns TRUE if validation is passed
     * 
     * @param \Slim\Http\Request $request
     * @return boolean
     */
    static function validateUser($request) {
        $error = FALSE;
        $em = AppContainer::getInstance()->getContainer()->get('em');
        $settings = AppContainer::getInstance()->getContainer()->get('settings');
        $flash = AppContainer::getInstance()->getContainer()->get('flash');
        
        $userSearch = $em->getRepository('App\Entity\User')->findOneBy(['name' => $request->getParam('user_name'), 'hidden' => 0]);
        $userName = $request->getParam('user_name');
        $userPass = $request->getParam('user_pass');
        $userPassRepeat = $request->getParam('user_pass_repeat');

        // if user already exists
        if ($userSearch instanceof User) {
            $flash->addMessage('message', LanguageUtility::trans('register-flash-m1') . ';' . BaseController::STYLE_DANGER);
            $error = TRUE;
        }

        // if $userName smaller than min length
        if (strlen($userName) < $settings['validation']['min_user_name_length']) {
            $flash->addMessage('message', LanguageUtility::trans('register-flash-m2') . ';' . BaseController::STYLE_DANGER);
            $error = TRUE;
        }

        // if $userName taller than max length
        if (strlen($userName) > $settings['validation']['max_user_name_length']) {
            $flash->addMessage('message', LanguageUtility::trans('register-flash-mXA') . ';' . BaseController::STYLE_DANGER);
            $error = TRUE;
        }

        // if $userName smaller than min length
        if (strlen($userPass) < $settings['validation']['min_password_length'] || strlen($userPassRepeat) < $settings['validation']['min_password_length']) {
            $flash->addMessage('message', LanguageUtility::trans('register-flash-m3') . ';' . BaseController::STYLE_DANGER);
            $error = TRUE;
        }

        // if password and password repeat not the same
        if ($userPass !== $userPassRepeat) {
            $flash->addMessage('message', LanguageUtility::trans('register-flash-m4') . ';' . BaseController::STYLE_DANGER);
            $error = TRUE;
        }

        // if $userName contains illegal chars
        foreach (str_split($userName) as $char) {
            // if char not allowed
            if (!in_array(strtolower($char), $settings['validation']['allowed_user_name_chars'])) {
                $flash->addMessage('message', LanguageUtility::trans('register-flash-mXB') . ';' . BaseController::STYLE_DANGER);
                $error = TRUE;
                break;
            }
        }

        $activeRoutes = $settings['locale']['active'];

        // if is domain mode
        if (LanguageUtility::processHas(LanguageUtility::LOCALE_URL) 
            && LanguageUtility::processHas(LanguageUtility::DOMAIN_ENABLED)) {
            $activeRoutes[$settings['locale']['generic_code']] = '';
        }

        // if is session mode
        if (LanguageUtility::processHas(LanguageUtility::LOCALE_SESSION) 
            && LanguageUtility::processHas(LanguageUtility::DOMAIN_DISABLED)) {
            unset($activeRoutes);
            $activeRoutes[$settings['locale']['generic_code']] = '';
        }

        // if $userName is equal to a route
        foreach ($activeRoutes as $activeLocale => $domain) {
            if (is_readable($settings['config_path'] . 'routes/' . $activeLocale . '.php')) {
                $routes = require $settings['config_path'] . 'routes/' . $activeLocale . '.php';

                if (isset($routes) && is_array($routes)) {
                    foreach ($routes as $routeName => $route) {
                        if (str_replace('/', '', $route['route']) === strtolower($userName)) {
                            $flash->addMessage('message', LanguageUtility::trans('register-flash-mXC') . ';' . BaseController::STYLE_DANGER);
                            $error = TRUE;
                            break;
                        }
                    }
                }
            } else {
                $flash->addMessage('message', LanguageUtility::trans('register-flash-mXD') . ';' . BaseController::STYLE_DANGER);
                $error = TRUE;
            }
        }
        
        return !$error;
    }
}
