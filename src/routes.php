<?php

use App\Utility\LanguageUtility;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->add(function (Request $request, Response $response, callable $next) {
    $route = $request->getAttribute('route');

    // return NotFound for non existent route
//    if (empty($route)) {
//        throw new NotFoundException($request, $response);
//    }

    if (!empty($route)) {
        $name = $route->getName();
        #$groups = $route->getGroups();
        #$methods = $route->getMethods();
        $arguments = $route->getArguments();

        // information for twig extension
        $_SESSION['route'] = $name;
        $_SESSION['route-args'] = $arguments;

        LanguageUtility::languageDetection($name, $arguments);
    }

    return $next($request, $response);
});

// initialize all routes from all active languages
foreach ($settings['settings']['locale']['active'] as $activeLocale => $domain) {
    // if is session mode
    if (\App\Utility\LanguageUtility::processHas(\App\Utility\LanguageUtility::DOMAIN_DISABLED) 
            && \App\Utility\LanguageUtility::processHas(\App\Utility\LanguageUtility::LOCALE_SESSION)) {
        $activeLocale = $settings['settings']['locale']['generic_code'];
    }

    // if translation file exists, load file to $locale
    if (is_readable($settings['settings']['config_path'] . 'routes/' . $activeLocale . '.php')) {
        $routes = require $settings['settings']['config_path'] . 'routes/' . $activeLocale . '.php';
        $suffixName = '-' . strtolower($activeLocale);

        if (isset($routes) && is_array($routes)) {
            foreach ($routes as $routeName => $route) {
                $app->map($route['methods'], $route['route'], $route['method'])->setName($routeName . $suffixName);
            }
        }
    }

    // if is session mode and $activeLocale = xx-XX
    if (\App\Utility\LanguageUtility::processHas(\App\Utility\LanguageUtility::DOMAIN_DISABLED) 
            && \App\Utility\LanguageUtility::processHas(\App\Utility\LanguageUtility::LOCALE_SESSION)
            && $activeLocale === $settings['settings']['locale']['generic_code']) {
        break;
    }
}