<?php
namespace App\Utility;

use App\Container\AppContainer;

class LanguageUtility {
    
    const LOCALE_URL = 1;
    const LOCALE_SESSION = 2;
    const DOMAIN_ENABLED = 4;
    const DOMAIN_DISABLED = 8;

    /**
     * Get translation by translation key
     * See http://php.net/manual/de/function.sprintf.php to use $vars
     * 
     * @param string $key translation key
     * @param array $vars optional
     * @return string
     */
    static function trans($key, $vars = []) {
        $settings = AppContainer::getInstance()->getContainer()->get('settings');
        
        // if translation file exists, load file to $locale
        if (is_readable($settings['locale']['path'] . $settings['locale']['code'] . '.php')) {
            $locale = require $settings['locale']['path'] . $settings['locale']['code'] . '.php';
        } else {
            // return translation key
            return $key;
        }
        
        // if translation exists, return translation
        if (isset($locale[$key])) {
            
            // $vars not empty and bigger than 0
            if (!empty($vars) && count($vars) > 0) {
                // replace placeholders in translation with $vars and return to frontend
                return vsprintf($locale[$key], $vars);
            }
            
            // return matching translation
            return $locale[$key];
        }
        
        // given key is not matching
        return $key;
    }
    
    /**
     * Detects browser language and redirects to browser language related page
     * 
     * @param string $routeName
     * @param array $routeArgs
     * @return type
     */
    static function languageDetection($routeName, $routeArgs) {
        $app = AppContainer::getInstance();
        $settings = $app->getContainer()->get('settings');

        // if server has HTTP_ACCEPT_LANGUAGE and auto_detect is active
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) 
                && is_string($_SERVER['HTTP_ACCEPT_LANGUAGE']) 
                && isset($settings['locale']['auto_detect'])
                && $settings['locale']['auto_detect'] === TRUE) {
            $browserLocales = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
            $localeQuality = [];

            // convert $_SERVER['HTTP_ACCEPT_LANGUAGE'] to array
            foreach ($browserLocales as $browserLocale) {
                $quality = 1;

                // if quality is defined 
                if (strpos($browserLocale, 'q=')) {
                    list($locale, $quality) = explode(';', $browserLocale);
                    $quality = floatval(str_replace('q=', '', $quality));
                } else {
                    $locale = $browserLocale;
                }

                $localeQuality[] = array(
                    'locale' => $locale,
                    'quality' => $quality,
                );
            }

            // locale with highest quality first
            usort($localeQuality, [LanguageUtility::class, 'localeQualityAsc']);

            // if $localeQuality could decoded
            if (is_array($localeQuality) && count($localeQuality) > 0) {
                foreach ($settings['locale']['active'] as $activeLocale => $domain) {
                    $locale = $localeQuality[0]['locale'];

                    // locale has no '-' sign
                    if (strpos($locale, '-') === FALSE) {
                        // add sign and region
                        $locale .= '-' . strtoupper($locale);
                    }

                    // if translation file exists, load file to $locale
                    $autoDetectCookie = isset($_COOKIE['auto_detect']) ? (int)$_COOKIE['auto_detect'] : 0;
                    if (is_readable($settings['locale']['path'] . $activeLocale . '.php') 
                            && $activeLocale === $locale && $autoDetectCookie !== 1) {
                        if (self::processHas(self::DOMAIN_DISABLED) && self::processHas(self::LOCALE_SESSION)) {
                            setcookie('current_locale', $activeLocale, 0, '/');
                            $activeLocale = $settings['locale']['generic_code'];
                        }
                        
                        $currentRouteName = substr($routeName, 0, -6);
                        $suffixName = strtolower($activeLocale);
                        $newRouteName = substr($routeName, 0, -6) . '-' . $suffixName;
                        $routes = require $settings['config_path'] . 'routes/' . $activeLocale . '.php';
                
                        if (self::processHas(self::DOMAIN_ENABLED) && !isset($routes[$currentRouteName])) {
                            $newRouteName = substr($routeName, 0, -6) . '-' . strtolower($settings['locale']['generic_code']);
                        }
                        
                        $compiledRoute = $app->getContainer()->get('router')->pathFor($newRouteName, $routeArgs);
                        
                        if (self::processHas(self::DOMAIN_ENABLED)) {
                            $compiledRoute = $_SERVER['REQUEST_SCHEME'] . '://' . $domain . $compiledRoute;
                        }

                        setcookie('auto_detect', 1, 0, '/');
                        // if browser language unlike current language 
                        if ($routeName !== $newRouteName || $domain !== $_SERVER['SERVER_NAME']) {
                            header('Location: ' . $compiledRoute);
                            exit;
                        }
                    }
                }
            }
        }
    }

    /**
     * @param array $a
     * @param array $b
     * @return boolean
     */
    static function localeQualityAsc($a, $b) {
        return $b['quality'] > $a['quality'];
    }
    
    /**
     * Returns TRUE if process has $flag
     * 
     * @param integer $flag
     * @return boolean
     */
    static function processHas($flag) {
        $settings = AppContainer::getInstance()->getContainer()->get('settings');
        return (($settings['locale']['process'] & $flag) == $flag);
    }
    
    /**
     * Returns the current locale code
     * 
     * @return string
     */
    static function getCurrentLocale() {
        $settings = AppContainer::getInstance()->getContainer()->get('settings');
        return $settings['locale']['code'];
    }
    
    /**
     * Get current language-region combination
     * Sample: {{ language() }}
     * 
     * @return string
     */
    static function getLocale() {
        $settings = AppContainer::getInstance()->getContainer()->get('settings');
        if (self::processHas(self::DOMAIN_DISABLED) && self::processHas(self::LOCALE_SESSION)) {
            return strtolower($settings['locale']['generic_code']);
        } else {
            return strtolower($settings['locale']['code']);
        }
    }
    
    /**
     * Get generic language code
     * Sample: {{ genericLanguage() }}
     * 
     * @return string
     */
    static function getGenericLocale() {
        $settings = AppContainer::getInstance()->getContainer()->get('settings');
        if (self::processHas(self::DOMAIN_ENABLED) 
                || (self::processHas(self::DOMAIN_DISABLED) && self::processHas(self::LOCALE_SESSION))) {
            return strtolower($settings['locale']['generic_code']);
        } else {
            return strtolower($settings['locale']['code']);
        }
    }
}
