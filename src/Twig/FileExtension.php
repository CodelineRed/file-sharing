<?php
namespace App\Twig;

/**
 * File twig extension
 */
class FileExtension extends \Twig_Extension {
    
    const B = 1;
    const KB = 1024;
    const MB = 1048576; // 1024 * 1024
    const GB = 1073741824; // 1024 * 1024 * 1024
    const TB = 1099511627776; // 1024 * 1024 * 1024 * 1024
    const PB = 1125899906842624; // 1024 * 1024 * 1024 * 1024 * 1024

    /** @var \Slim\Container $container */
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function getName() {
        return 'file_ext';
    }

    /**
     * Twig filters
     * 
     * @return array
     */
    public function getFilters() {
        return [
            new \Twig_SimpleFilter('file_size', [$this, 'fileSize']),
        ];
    }
    
    /**
     * Returns current language-region or generic code
     * Sample: {{ file.size|file_size(2, '.', ',', 'MB') }}
     * 
     * @param string|integer $value file size in byte
     * @param integer $decimals sets the number of decimal points (default: 0)
     * @param integer $decimalPoint sets the separator for the decimal point (default: '.')
     * @param integer $thousandsSeparator sets the thousands separator (default: ',')
     * @param string $unit optional (default: '' = calculate unit automatically)
     * @return string
     */
    public function fileSize($value, $decimals = 0, $decimalPoint = '.', $thousandsSeparator = ',', $unit = '') {
        if (empty($unit) || !in_array(strtoupper($unit), ['B', 'KB', 'MB', 'GB', 'TB', 'PB'])) {
            if ($value < self::KB) {
                $decimals = 0;
                $unit = 'B';
            } elseif ($value >= self::KB && $value < self::MB) {
                $unit = 'KB';
            } elseif ($value >= self::MB && $value < self::GB) {
                $unit = 'MB';
            } elseif ($value >= self::GB && $value < self::TB) {
                $unit = 'GB';
            } elseif ($value >= self::TB && $value < self::PB) {
                $unit = 'TB';
            } else {
                $unit = 'PB';
            }
        }
        
        return number_format(intval($value) / constant('\App\Twig\FileExtension::' . strtoupper($unit)), $decimals, $decimalPoint, $thousandsSeparator) . ' ' . $unit;
    }
}