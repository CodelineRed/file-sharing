<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file")
 */
class File extends \App\MappedSuperclass\Base
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="files")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", name="hash_name")
     */
    private $hashName;
    
    /**
     * @ORM\ManyToOne(targetEntity="FileExtension", inversedBy="files")
     * @ORM\JoinColumn(name="extension", referencedColumnName="id")
     */
    private $extension;
    
    /**
     * @ORM\Column(type="string", name="mime_type")
     */
    private $mimeType;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $size;
    
    /**
     * @ORM\OneToOne(targetEntity="File")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     */
    private $file = NULL;
    
    /**
     * @ORM\Column(type="boolean", name="file_included")
     */
    private $fileIncluded = FALSE;
    
    /**
     * Get $user
     * 
     * @return User
     */
    public function getUser() {
        return $this->user;
    }
    
    /**
     * Set $user
     * 
     * @param User $user
     */
    public function setUser($user) {
        $this->user = $user;
        
        return $this;
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
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Get $hashName
     * 
     * @return string
     */
    public function getHashName() {
        return $this->hashName;
    }

    /**
     * Set $hashName
     * 
     * @param string $hashName
     */
    public function setHashName($hashName) {
        $this->hashName = $hashName;
        
        return $this;
    }

    /**
     * Get $extension
     * 
     * @return FileExtension
     */
    public function getExtension() {
        return $this->extension;
    }

    /**
     * Set $extension
     * 
     * @param FileExtension $extension
     */
    public function setExtension($extension) {
        $this->extension = $extension;
        
        return $this;
    }

    /**
     * Get $mimeType
     * 
     * @return string
     */
    public function getMimeType() {
        return $this->mimeType;
    }

    /**
     * Set $mimeType
     * 
     * @param string $mimeType
     */
    public function setMimeType($mimeType) {
        $this->mimeType = $mimeType;
        
        return $this;
    }

    /**
     * Get $size
     * 
     * @return integer
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * Set $size
     * 
     * @param integer $size
     */
    public function setSize($size) {
        $this->size = $size;
        
        return $this;
    }

    /**
     * Get $file
     * 
     * @return FileFile
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Set $file
     * 
     * @param FileFile $file
     */
    public function setFile($file) {
        $this->file = $file;
        
        return $this;
    }
    
    /**
     * Is $fileIncluded
     * 
     * @return boolean
     */
    public function isFileIncluded() {
        return $this->fileIncluded;
    }
    
    /**
     * Set $fileIncluded
     * 
     * @param boolean $fileIncluded
     */
    public function setFileIncluded($fileIncluded) {
        $this->fileIncluded = $fileIncluded;
        
        return $this;
    }
}