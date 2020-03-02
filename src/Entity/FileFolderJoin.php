<?php
namespace App\Entity;

use App\MappedSuperclass\BaseJoin;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file_folder_join")
 */
class FileFolderJoin extends BaseJoin {
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="File", inversedBy="folderJoins")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=false)
     */
    private $file;
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Folder", inversedBy="fileJoins")
     * @ORM\JoinColumn(name="folder_id", referencedColumnName="id", nullable=false)
     */
    private $folder;
    
    /**
     * Get file $id
     * 
     * @return string
     */
    public function getFileId() {
        return $this->file->getId();
    }
    
    /**
     * Get file $name
     * 
     * @return string
     */
    public function getFileName() {
        return $this->file->getName();
    }
    
    /**
     * Get file $access
     * 
     * @return integer
     */
    public function getFileAccess() {
        return $this->file->getAccess();
    }
    
    /**
     * Get file $access id
     * 
     * @return integer
     */
    public function getFileAccessId() {
        return $this->file->getAccessId();
    }
    
    /**
     * Get file $updatedAt
     * 
     * @return \DateTime
     */
    public function getFileUpdatedAt() {
        return $this->file->updatedAt;
    }
    
    /**
     * Get file $createdAt
     * 
     * @return \DateTime 
     */
    public function getFileCreatedAt() {
        return $this->file->createdAt;
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
     * @return FileFolderJoin
     */
    public function setFile($file) {
        $this->file = $file;
        
        return $this;
    }
    
    /**
     * Get $file
     * 
     * @return Folder
     */
    public function getFolder() {
        return $this->folder;
    }

    /**
     * Set $folder
     * 
     * @param Folder $folder
     * @return FileFolderJoin
     */
    public function setFolder($folder) {
        $this->folder = $folder;
        
        return $this;
    }
    
    /**
     * Get folder $id
     * 
     * @return string
     */
    public function getFolderId() {
        return $this->folder->getId();
    }
    
    /**
     * Get folder $name
     * 
     * @return string
     */
    public function getFolderName() {
        return $this->folder->getName();
    }
    
    /**
     * Get folder $access
     * 
     * @return integer
     */
    public function getFolderAccess() {
        return $this->folder->getAccess();
    }
    
    /**
     * Get folder $access id
     * 
     * @return integer
     */
    public function getFolderAccessId() {
        return $this->folder->getAccessId();
    }
    
    /**
     * Get folder $updatedAt
     * 
     * @return \DateTime
     */
    public function getFolderUpdatedAt() {
        return $this->folder->updatedAt;
    }
    
    /**
     * Get folder $createdAt
     * 
     * @return \DateTime 
     */
    public function getFolderCreatedAt() {
        return $this->folder->createdAt;
    }
}