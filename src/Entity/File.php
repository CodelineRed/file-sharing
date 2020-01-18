<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file")
 */
class File extends \App\MappedSuperclass\Base {
    
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
     * File name in upload folder
     * 
     * @ORM\Column(type="string", name="hash_name", options={"comment": "File name in upload folder"})
     */
    private $hashName;
    
    /**
     * @ORM\ManyToOne(targetEntity="FileExtension", inversedBy="files")
     * @ORM\JoinColumn(name="file_extension_id", referencedColumnName="id")
     */
    private $extension;
    
    /**
     * @ORM\Column(type="string", name="mime_type")
     */
    private $mimeType;
    
    /**
     * Size in bytes
     * 
     * @ORM\Column(type="string", options={"comment": "Size in bytes"})
     */
    private $size;
    
    /**
     * ID of the comment related to the file
     * 
     * @ORM\OneToOne(targetEntity="File", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $file = NULL;
    
    /**
     * 1 if note is related to a file
     * 
     * @ORM\Column(type="boolean", name="file_included", options={"comment": "1 if note is related to a file"})
     */
    private $fileIncluded = FALSE;
    
    /**
     * Access tiers: 0 = private, 1 = shareable, 2 = public
     * 
     * @ORM\Column(type="smallint", options={"comment": "0 = private, 1 = shareable, 2 = public"})
     */
    protected $access = 0;
    
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
     * @return string
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * Set $size
     * 
     * @param string|integer $size
     */
    public function setSize($size) {
        $this->size = (string)$size;
        
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
    
    /**
     * Is $access
     * 
     * @return integer
     */
    public function getAccess() {
        return $this->access;
    }
    
    /**
     * Set $access
     * 
     * @param integer $access
     */
    public function setAccess($access) {
        $this->access = $access;
        
        return $this;
    }
}