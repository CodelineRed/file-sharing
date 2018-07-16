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
     * @ORM\Column(type="boolean")
     */
    private $public = 0;
    
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
     * Get $hashName
     * 
     * @return string
     */
    function getHashName() {
        return $this->hashName;
    }

    /**
     * Set $hashName
     * 
     * @param string $hashName
     */
    function setHashName($hashName) {
        $this->hashName = $hashName;
        
        return $this;
    }

    /**
     * Get $extension
     * 
     * @return FileExtension
     */
    function getExtension() {
        return $this->extension;
    }

    /**
     * Set $extension
     * 
     * @param FileExtension $extension
     */
    function setExtension($extension) {
        $this->extension = $extension;
        
        return $this;
    }

    /**
     * Get $mimeType
     * 
     * @return string
     */
    function getMimeType() {
        return $this->mimeType;
    }

    /**
     * Set $mimeType
     * 
     * @param string $mimeType
     */
    function setMimeType($mimeType) {
        $this->mimeType = $mimeType;
        
        return $this;
    }

    /**
     * Get $size
     * 
     * @return integer
     */
    function getSize() {
        return $this->size;
    }

    /**
     * Set $size
     * 
     * @param integer $size
     */
    function setSize($size) {
        $this->size = $size;
        
        return $this;
    }
    
    /**
     * Is $public
     * 
     * @return boolean
     */
    public function isPublic() {
        return $this->public;
    }
    
    /**
     * Set $public
     * 
     * @param boolean $public
     */
    public function setPublic($public) {
        $this->public = $public;
        
        return $this;
    }
}