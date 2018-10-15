<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file_extension")
 */
class FileExtension extends \App\MappedSuperclass\Base
{
    
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="FileType", inversedBy="fileExtensions")
     * @ORM\JoinColumn(name="file_type", referencedColumnName="id")
     */
    private $fileType;
    
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
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set $name
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->name = strtolower($name);
        
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