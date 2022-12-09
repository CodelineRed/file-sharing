<?php
return [
    'settings' => [
        'displayErrorDetails' => false, // set to false in production

        // Renderer settings
        'renderer' => [
            'cache' => false,  // __DIR__ . '/../cache/',
            'debug' => false,
        ],
        
        // Doctrine settings
        'doctrine' => [
            'connection' => [
                'dbname'      => isset($_ENV['APP_DB_NAME']) ? $_ENV['APP_DB_NAME'] : 'file_sharing',
                'host'        => isset($_ENV['APP_DB_HOST']) ? $_ENV['APP_DB_HOST'] : 'localhost',
                'port'        => isset($_ENV['APP_DB_PORT']) ? $_ENV['APP_DB_PORT'] : 3306,
                'user'        => isset($_ENV['APP_DB_USER']) ? $_ENV['APP_DB_USER'] : '',
                'password'    => isset($_ENV['APP_DB_PASSWORD']) ? $_ENV['APP_DB_PASSWORD'] : '',
                'unix_socket' => isset($_ENV['APP_DB_SOCKET']) ? $_ENV['APP_DB_SOCKET'] : '',
            ],
        ],

        // Google recaptcha
        'recaptcha' => [
            'site'   => '',
            'secret' => '',
        ],
        
        // Google QR Code title
        '2fa_qrc_title' => null,
        
        // pages for the public
        'active_pages' => [
            'login'    => true,
            'register' => true,
        ],
        
        // User validation
        'validation' => [
            'min_user_name_length'    => 4,
            'max_user_name_length'    => 50,
            'min_password_length'     => 6,
            'password_with_digit'     => true, // digit required
            'password_with_lcc'       => true, // lowercase character required
            'password_with_ucc'       => true, // uppercase character required
            'password_with_nwc'       => true, // non-word character required
            'allowed_user_name_chars' => str_split('abcdefghijklmnopqrstuvwxyz0123456789-_'),
        ],
        
        // Locale settings
        'locale' => [
            'process'     => \App\Utility\LanguageUtility::LOCALE_SESSION | \App\Utility\LanguageUtility::DOMAIN_DISABLED,
            'auto_detect' => true,
            'code'        => 'en-US', // default / current language
            'active' => [
                'en-US' => 'imhh-fs.localhost',
                'de-DE' => 'imhh-fs.localhost',
            ],
        ],
    ],
];
