<?php
namespace App\Twig;

/**
 * CSRF Twig extension
 */
class CsrfExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface {

    /** @var \Slim\Csrf\Guard $csrf */
    protected $csrf;

    public function __construct($container) {
        $this->csrf = $container->get('csrf');
    }

    public function getGlobals() {
        // CSRF token name and value
        $csrfNameKey = $this->csrf->getTokenNameKey();
        $csrfValueKey = $this->csrf->getTokenValueKey();
        $csrfName = $this->csrf->getTokenName();
        $csrfValue = $this->csrf->getTokenValue();

        return [
            'csrf'   => [
                'keys' => [
                    'name'  => $csrfNameKey,
                    'value' => $csrfValueKey
                ],
                'name'  => $csrfName,
                'value' => $csrfValue
            ]
        ];
    }

    public function getName() {
        return 'csrf_ext';
    }
}