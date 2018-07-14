<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file_type")
 */
class FileType extends \App\MappedSuperclass\Base
{
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="FileExtension", mappedBy="file_type")
     */
    private $fileExtensions;

    public function __construct() {
        $this->fileExtensions = new ArrayCollection();
    }
    
    /**
     * Get $name
     * 
     * @return string
     */
    function getName() {
        return $this->name;
    }

    /**
     * Set $name
     * 
     * @param string $name
     */
    function setName($name) {
        $this->name = $name;
        
        return $this;
    }
}