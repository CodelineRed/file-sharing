<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file_extension")
 */
class FileExtension extends \App\MappedSuperclass\Base
{
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="FileType", inversedBy="fileExtensions")
     * @ORM\JoinColumn(name="file_type", referencedColumnName="id")
     */
    private $fileType;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $active = 1;
    
    /**
     * @ORM\OneToMany(targetEntity="File", mappedBy="extension")
     */
    private $files;

    public function __construct() {
        $this->files = new ArrayCollection();
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
    
    /**
     * Has $active
     * 
     * @return boolean
     */
    public function isActive() {
        return $this->active;
    }
    
    /**
     * Set $active
     * 
     * @param boolean $active
     */
    public function setActive($active) {
        $this->active = $active;
        
        return $this;
    }

    /**
     * Get $fileType
     * 
     * @return FileType
     */
    function getFileType() {
        return $this->fileType;
    }

    /**
     * Set $fileType
     * 
     * @param FileType $fileType
     */
    function setFileType($fileType) {
        $this->fileType = $fileType;
        
        return $this;
    }
}