<?php
namespace App\Twig;

use App\Container\AppContainer;
use Doctrine\ORM\PersistentCollection;

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
            new \Twig_SimpleFilter('unique_files_quantity', [$this, 'uniqueFilesQuantity']),
        ];
    }

    /**
     * Returns file size in human readable format
     * Sample: {{ file.size|file_size(2, '.', ',', 'MB') }}
     * 
     * @param string|integer $bytes file size in bytes
     * @param integer $decimals sets the number of decimal points (default: 0)
     * @param integer $decimalPoint sets the separator for the decimal point (default: '.')
     * @param integer $thousandsSeparator sets the thousands separator (default: ',')
     * @param string $unit optional (default: '' = calculate unit automatically)
     * @return string
     */
    public function fileSize($bytes, $decimals = 0, $decimalPoint = '.', $thousandsSeparator = ',', $unit = '') {
        if (empty($unit) || !in_array(strtoupper($unit), ['B', 'KB', 'MB', 'GB', 'TB', 'PB'])) {
            if ($bytes < self::KB) {
                $decimals = 0;
                $unit = 'B';
            } elseif ($bytes >= self::KB && $bytes < self::MB) {
                $unit = 'KB';
            } elseif ($bytes >= self::MB && $bytes < self::GB) {
                $unit = 'MB';
            } elseif ($bytes >= self::GB && $bytes < self::TB) {
                $unit = 'GB';
            } elseif ($bytes >= self::TB && $bytes < self::PB) {
                $unit = 'TB';
            } else {
                $unit = 'PB';
            }
        }
        
        return number_format(intval($bytes) / constant('\App\Twig\FileExtension::' . strtoupper($unit)), $decimals, $decimalPoint, $thousandsSeparator) . ' ' . $unit;
    }

    /**
     * Returns quantity of unique files
     *
     * @param PersistentCollection $files
     * @return mixed
     */
    public function uniqueFilesQuantity(PersistentCollection $files) {
        $em = AppContainer::getInstance()->getContainer()->get('em');
        return $em->getRepository('App\Entity\User')->findUniqueFiles($files)->count();
    }
}