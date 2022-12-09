<?php
namespace App\Entity;

use App\MappedSuperclass\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fs_upload_limit")
 */
class UploadLimit extends Base {

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    /**
     * Size in bytes
     * 
     * @ORM\Column(type="string", options={"comment": "Size in bytes"})
     */
    private $size = '104857600'; // 100MB

    /**
     * Size in bytes
     *
     * @ORM\Column(type="integer", options={"comment": "Max File quantity"})
     */
    private $files = 250;

    /**
     * Size in bytes
     *
     * @ORM\Column(type="integer", options={"comment": "Max Folder quantity"})
     */
    private $folders = 250;

    /**
     * One UploadLimit has many Users.
     *
     * @ORM\OneToMany(targetEntity="User", mappedBy="role")
     */
    private $users;

    public function __construct() {
        $this->users = new ArrayCollection();
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
     * @return UploadLimit
     */
    public function setName($name) {
        $this->name = trim($name);

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
     * @return UploadLimit
     */
    public function setSize($size) {
        $this->size = (string)$size;

        return $this;
    }

    /**
     * Get $files
     * 
     * @return integer
     */
    public function getFiles() {
        return $this->files;
    }

    /**
     * Set $files
     *
     * @param integer $files
     * @return UploadLimit
     */
    public function setFiles($files) {
        $this->files = $files;

        return $this;
    }

    /**
     * Get $folders
     * 
     * @return integer
     */
    public function getFolders() {
        return $this->folders;
    }

    /**
     * Set $folders
     *
     * @param integer $folders
     * @return UploadLimit
     */
    public function setFolders($folders) {
        $this->folders = $folders;

        return $this;
    }

    /**
     * Get $users
     *
     * @return PersistentCollection
     */
    public function getUsers() {
        return $this->users;
    }
}