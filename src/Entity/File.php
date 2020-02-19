<?php
namespace App\Entity;

use App\MappedSuperclass\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file")
 */
class File extends Base {
    
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
     * ID of the comment related to the file
     * 
     * @ORM\OneToOne(targetEntity="File", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $file = NULL;
    
    /**
     * @ORM\ManyToOne(targetEntity="FileExtension", inversedBy="files")
     * @ORM\JoinColumn(name="file_extension_id", referencedColumnName="id", nullable=false)
     */
    private $extension;
    
    /**
     * @ORM\ManyToOne(targetEntity="Access", inversedBy="files")
     * @ORM\JoinColumn(name="access_id", referencedColumnName="id", nullable=false)
     */
    protected $access;
    
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
     * 1 if note is related to a file
     * 
     * @ORM\Column(type="boolean", name="file_included", options={"comment": "1 if note is related to a file"})
     */
    private $fileIncluded = FALSE;
    
    /** 
     * Many Files can have Many Folders.
     * 
     * @ORM\OneToMany(targetEntity="FileFolderJoin", mappedBy="file", cascade={"persist", "remove"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $folderJoins;
    
    public function __construct() {
        $this->folderJoins = new ArrayCollection();
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
     * Get $folderJoins
     * 
     * @return PersistentCollection
     */
    public function getFolderJoins() {
        return $this->folderJoins;
    }
    
    /**
     * Get $folders
     * 
     * @return array
     */
    public function getFoldersArray() {
        $folders = [];

        foreach ($this->getUser()->getFolders() as $userFolder) {
            $selected = FALSE;
            $access = $userFolder->getAccess();
            
            foreach ($this->folderJoins as $folderJoin) {
                if ($userFolder->getId() === $folderJoin->getFolderId()) {
                    $selected = TRUE;
                    break;
                }
            }
            
            $folders[] = [
                'id' => $userFolder->getId(),
                'name' => $userFolder->getName(),
                'access' => $userFolder->getAccessId(),
                'access_icon' => $access->getIcon(),
                'access_button' => $access->getButton(),
                'selected' => $selected,
            ];
        }
        
        // order by folder name ASC
        if (count($folders)) {
            usort($folders, function ($a, $b) {
                return ($a['name'] < $b['name']) ? -1 : 1;
            });
        }
        
        return $folders;
    }
}