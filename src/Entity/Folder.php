<?php
namespace App\Entity;

use App\MappedSuperclass\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FolderRepository")
 * @ORM\Table(name="imhhfs_folder")
 */
class Folder extends Base {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="files")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Access", inversedBy="folders")
     * @ORM\JoinColumn(name="access_id", referencedColumnName="id", nullable=false)
     */
    protected $access;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * Many Folders can have Many Files.
     * 
     * @ORM\OneToMany(targetEntity="FileFolderJoin", mappedBy="folder", cascade={"persist", "remove"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $fileJoins;
    
    public function __construct() {
        $this->fileJoins = new ArrayCollection();
    }
    
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
        $this->name = trim($name);
        
        return $this;
    }
    
    /**
     * Get access id
     * 
     * @return integer
     */
    public function getAccessId() {
        if ($this->access instanceof Access) {
            return $this->access->getId();
        }
        
        return 1;
    }
    
    /**
     * Get access
     * 
     * @return Access|null
     */
    public function getAccess() {
        
        return $this->access;
    }
    
    /**
     * Set $access
     * 
     * @param Access $access
     */
    public function setAccess(Access $access) {
        $this->access = $access;
        
        return $this;
    }
    
    /**
     * Get $fileJoins
     * 
     * @return PersistentCollection
     */
    public function getFileJoins() {
        return $this->fileJoins;
    }
}