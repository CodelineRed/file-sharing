<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file_extension")
 */
class FileExtension extends \App\MappedSuperclass\LowerCaseUniqueName
{
    
    /**
     * @ORM\ManyToOne(targetEntity="FileType", inversedBy="fileExtensions")
     * @ORM\JoinColumn(name="file_type", referencedColumnName="id")
     */
    private $fileType;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $active = 0;
    
    /**
     * @ORM\OneToMany(targetEntity="File", mappedBy="extension")
     */
    private $files;

    public function __construct() {
        $this->files = new ArrayCollection();
    }
    
    /**
     * Is $active
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
    public function getFileType() {
        return $this->fileType;
    }

    /**
     * Set $fileType
     * 
     * @param FileType $fileType
     */
    public function setFileType($fileType) {
        $this->fileType = $fileType;
        
        return $this;
    }
}