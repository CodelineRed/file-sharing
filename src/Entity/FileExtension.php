<?php
namespace App\Entity;

use App\MappedSuperclass\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file_extension")
 */
class FileExtension extends Base {
    
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="FileType", inversedBy="fileExtensions")
     * @ORM\JoinColumn(name="file_type_id", referencedColumnName="id", nullable=false)
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
     * @return FileExtension
     */
    public function setName($name) {
        $this->name = strtolower(trim($name));
        
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
     * @return FileExtension
     */
    public function setFileType($fileType) {
        $this->fileType = $fileType;
        
        return $this;
    }
    
    /**
     * Get $files
     * 
     * @return PersistentCollection
     */
    public function getFiles() {
        return $this->files;
    }
}