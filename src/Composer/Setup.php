<?php
namespace App\Composer;

use Composer\Script\Event;

class Setup {
    
    /**
     * Generates additional-settings.php and set up database
     * 
     * @param Event $event
     */
    public static function run(Event $event) {
        if (isset($_ENV['docker'])) {
            echo self::getColoredString("Skipped App\\Composer\\Setup in Docker environment.\n", 'green');
            return;
        }
        
        $arrConfig = [];
        $s = '    ';
        $settings = "<?php\nreturn [\n$s'settings' => [\n";

        if (!file_exists(__DIR__ . "/../../config/additional-settings.php")) {
            
            if (!file_exists(__DIR__ . "/../../config/additional-settings.dist.php")) {
                copy(__DIR__ . "/../../config/additional-settings.dist.php", __DIR__ . "/../../config/additional-settings.php");
            }
            
            $arrConfig['database'] = [];

            // Ask for database name
            echo self::getColoredString("Please enter value for displayErrorDetails (default: ", 'green') . self::getColoredString("TRUE", 'yellow') . self::getColoredString("): ", 'green');
            $strHandle = fopen("php://stdin", "r");
            echo "\n";

            $strDisplayErrors = trim(fgets($strHandle));

            if (empty($strDisplayErrors)) {
                $settings .= "$s$s'displayErrorDetails' => TRUE";
            } else {
                $settings .= "$s$s'displayErrorDetails' => " . $strDisplayErrors;
            }
            
            $settings .= ",  // set to false in production\n\n";
            fclose($strHandle);
            
            // Database setting
            $settings .= "$s$s// Doctrine settings\n";
            $settings .= "$s$s'doctrine' => [\n";
            $settings .= "$s$s$s'connection' => [\n";

            // Ask for database name
            echo self::getColoredString("Please enter database name (default: ", 'green') . self::getColoredString("imhh_file_sharing", 'yellow') . self::getColoredString("): ", 'green');
            $strHandle = fopen("php://stdin", "r");
            echo "\n";

            $strDbName = trim(fgets($strHandle));
            fclose($strHandle);

            if (empty($strDbName)) {
                $arrConfig['database']['dbname'] = "imhh_file_sharing";
            } else {
                $arrConfig['database']['dbname'] = $strDbName;
            }
            $settings .= "$s$s$s$s'dbname'   => isset(\$_ENV['APP_DB_NAME']) ? \$_ENV['APP_DB_NAME'] : '" . $arrConfig['database']['dbname'] . "',\n";

            // Ask for database host
            echo self::getColoredString("Please enter database host (default: ", 'green') . self::getColoredString("127.0.0.1", 'yellow') . self::getColoredString("): ", 'green');
            $strHandle = fopen("php://stdin", "r");
            echo "\n";

            $strHost = trim(fgets($strHandle));
            fclose($strHandle);

            if (empty($strHost)) {
                $arrConfig['database']['host'] = "127.0.0.1";
            } else {
                $arrConfig['database']['host'] = $strHost;
            }
            $settings .= "$s$s$s$s'host'     => isset(\$_ENV['APP_DB_HOST']) ? \$_ENV['APP_DB_HOST'] : '" . $arrConfig['database']['host'] . "',\n";

            // Ask for database port
            echo self::getColoredString("Please enter database port (default: ", 'green') . self::getColoredString("3306", 'yellow') . self::getColoredString("): ", 'green');
            $strHandle = fopen("php://stdin", "r");
            echo "\n";

            $intPort = (int)trim(fgets($strHandle));
            fclose($strHandle);

            if (empty($intPort)) {
                $arrConfig['database']['port'] = 3306;
            } else {
                $arrConfig['database']['port'] = $intPort;
            }
            $settings .= "$s$s$s$s'port'     => isset(\$_ENV['APP_DB_PORT']) ? \$_ENV['APP_DB_PORT'] : " . $arrConfig['database']['port'] . ",\n";

            // Ask for database user
            echo self::getColoredString("Please enter database user (default: ", 'green') . self::getColoredString("root", 'yellow') . self::getColoredString("): ", 'green');
            $strHandle = fopen("php://stdin", "r");
            echo "\n";

            $strUser = trim(fgets($strHandle));
            fclose($strHandle);

            if (empty($strUser)) {
                $arrConfig['database']['user'] = "root";
            } else {
                $arrConfig['database']['user'] = $strUser;
            }
            $settings .= "$s$s$s$s'user'     => isset(\$_ENV['APP_DB_USER']) ? \$_ENV['APP_DB_USER'] : '" . $arrConfig['database']['user'] . "',\n";

            // Ask for database password
            echo self::getColoredString("Please enter database password: ", 'green');
            $strHandle = fopen("php://stdin", "r");
            echo "\n";

            $strPassword = trim(fgets($strHandle));
            fclose($strHandle);

            if (empty($strPassword)) {
                $arrConfig['database']['password'] = "";
            } else {
                $arrConfig['database']['password'] = $strPassword;
            }
            $settings .= "$s$s$s$s'password' => isset(\$_ENV['APP_DB_PASSWORD']) ? \$_ENV['APP_DB_PASSWORD'] : '" . $arrConfig['database']['password'] . "',\n";
            $settings .= "$s$s$s],\n$s$s],\n\n";
            
            // Public path
            // Ask for public path
            echo self::getColoredString("Please enter public path (default: ", 'green') . self::getColoredString("dynamic generated", 'yellow') . self::getColoredString("): ", 'green');
            $strHandle = fopen("php://stdin", "r");
            echo "\n";

            $strPublicPath = trim(fgets($strHandle));
            fclose($strHandle);

            if (empty($strPublicPath)) {
//                $settings .= "$s$s'public_path' => '/',\n";
            } else {
                $settings .= "\n$s$s// Relative to domain (e.g. project is in sub directory '/project/public/')\n";
                $settings .= "$s$s'public_path' => '$strPublicPath',\n";
            }
            
            // write additional-settings.php
            file_put_contents(__DIR__ . "/../../config/additional-settings.php", $settings . "$s],\n];\n");

            static::createDatabase($arrConfig['database']);
        } else {
            // Ask for import
            echo self::getColoredString("Should database reset to default records (default: ", 'green') . self::getColoredString("no", 'yellow') . self::getColoredString("): ", 'green');
            $strHandle = fopen("php://stdin", "r");
            echo "\n";

            $answer = strtolower(trim(fgets($strHandle)));

            if ($answer === 'y' || $answer === 'yes') {
                $settings = require_once __DIR__ . "/../../config/additional-settings.php";
                
                static::importDatabase([
                    'dbname'   => $settings['settings']['doctrine']['connection']['dbname'],
                    'host'     => $settings['settings']['doctrine']['connection']['host'],
                    'port'     => $settings['settings']['doctrine']['connection']['port'],
                    'user'     => $settings['settings']['doctrine']['connection']['user'],
                    'password' => $settings['settings']['doctrine']['connection']['password']
                ]);
            }
        }
    }
    
    /**
     * @param array $configuration
     */
    protected static function createDatabase($configuration) {
        $mysql = new \mysqli($configuration['host'], $configuration['user'], $configuration['password'], '', $configuration['port']);

        if ($mysql->connect_error) {
            die("Connection failed: " . $mysql->connect_error);
        }

        $sql = "CREATE DATABASE IF NOT EXISTS `". $configuration['dbname'] . "` CHARACTER SET utf8 COLLATE utf8_general_ci;";

        if ($mysql->query($sql) === TRUE) {
            echo self::getColoredString("Database created successfully\n", 'green');
        } else {
            echo self::getColoredString("Error creating database: " . $mysql->error . "\n", 'red');
        }

        $mysql->close();

        static::importDatabase($configuration);
    }
    
    /**
     * @param array $configuration
     */
    protected static function importDatabase($configuration) {
        $mysql = new \mysqli($configuration['host'], $configuration['user'], $configuration['password'], $configuration['dbname'], $configuration['port']);

        if ($mysql->connect_error) {
            die("Connection failed: " . $mysql->connect_error);
        }

        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file(__DIR__ . "/../../sql/db-dump.sql");
        // Loop through each line
        foreach ($lines as $line) {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                $mysql->query($templine) or print(self::getColoredString("Error performing query " . $templine . "': " . $mysql->error . "\n", 'red'));
                // Reset temp variable to empty
                $templine = '';
            }
        }

        $mysql->close();
    }
    
    /**
     * Returns colored text for CLI
     * 
     * @param string $string
     * @param string $foregroundColor
     * @param string $backgroundColor
     * @return string
     */
    protected static function getColoredString($string, $foregroundColor = null, $backgroundColor = null) {
        // skip colors on windows operating system
        if (strpos(strtolower(php_uname()), 'windows') !== FALSE) {
            return $string;
        }
        
        $foregroundColors = [
            'default' => '0',
            'black' => '0;30',
            'dark_gray' => '1;30',
            'blue' => '0;34',
            'light_blue' => '1;34',
            'green' => '0;32',
            'light_green' => '1;32',
            'cyan' => '0;36',
            'light_cyan' => '1;36',
            'red' => '0;31',
            'light_red' => '1;31',
            'purple' => '0;35',
            'light_purple' => '1;35',
            'brown' => '0;33',
            'yellow' => '0;33',
            'light_gray' => '0;37',
            'white' => '1;37',
        ];
        
        $backgroundColors = [
            'black' => '40',
            'red' => '41',
            'green' => '42',
            'yellow' => '43',
            'blue' => '44',
            'magenta' => '45',
            'cyan' => '46',
            'light_gray' => '47'
        ];

        $coloredString = "";

        // if given foreground color exists
        if (isset($foregroundColors[$foregroundColor])) {
            $coloredString .= "\033[" . $foregroundColors[$foregroundColor] . "m";
        }
        // if given background color exists
        if (isset($backgroundColors[$backgroundColor])) {
            $coloredString .= "\033[" . $backgroundColors[$backgroundColor] . "m";
        }

        // set default color at the end
        $coloredString .= $string . "\033[0m";

        return $coloredString;
    }
}
