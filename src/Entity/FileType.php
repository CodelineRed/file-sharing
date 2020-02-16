<?php
namespace App\Entity;

use App\MappedSuperclass\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file_type")
 */
class FileType extends Base {
    
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;
    
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
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set $name
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->name = strtolower(trim($name));
        
        return $this;
    }
    
    /**
     * Get $fileExtensions
     * 
     * @return PersistentCollection
     */
    public function getFileExtensions() {
        return $this->fileExtensions;
    }
}