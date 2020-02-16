<?php
namespace App\Entity;

use App\MappedSuperclass\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccessRepository")
 * @ORM\Table(name="imhhfs_access")
 */
class Access extends Base {
    
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", options={"comment": "Icon CSS class"})
     */
    protected $icon = 'lock';
    
    /**
     * @ORM\Column(type="string", options={"comment": "Button CSS class"})
     */
    protected $button = 'success';
    
    /**
     * One Access has many Files.
     * 
     * @ORM\OneToMany(targetEntity="File", mappedBy="access")
     */
    private $files;
    
    /**
     * One Access has many Folders.
     * 
     * @ORM\OneToMany(targetEntity="Folder", mappedBy="access")
     */
    private $folders;
    
    public function __construct() {
        $this->files = new ArrayCollection();
        $this->folders = new ArrayCollection();
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
     * Get $icon
     * 
     * @return string
     */
    public function getIcon() {
        return $this->icon;
    }
    
    /**
     * Set $icon
     * 
     * @param string $icon
     */
    public function setIcon($icon) {
        $this->icon = trim($icon);
        
        return $this;
    }
    
    /**
     * Get $button
     * 
     * @return string
     */
    public function getButton() {
        return $this->button;
    }
    
    /**
     * Set $button
     * 
     * @param string $button
     */
    public function setButton($button) {
        $this->button = trim($button);
        
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

    /**
     * Get $folders
     * 
     * @return PersistentCollection
     */
    public function getFolder() {
        return $this->folders;
    }
}