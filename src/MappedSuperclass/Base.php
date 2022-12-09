<?php
namespace App\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * This class is used for Entities
 * 
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
class Base {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $deleted = 0;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $hidden = 0;
    
    /**
     * Date and time in UTC
     * 
     * @ORM\Column(type="datetime", name="updated_at", options={"comment": "Date and time in UTC"})
     */
    protected $updatedAt;
    
    /**
     * Date and time in UTC
     * 
     * @ORM\Column(type="datetime", name="created_at", options={"comment": "Date and time in UTC"})
     */
    protected $createdAt = NULL;
    
    /**
     * Get $id
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Is $deleted
     * 
     * @return boolean
     */
    public function isDeleted() {
        return $this->deleted;
    }
    
    /**
     * Set $deleted
     * 
     * @param boolean $deleted
     * @return Base
     */
    public function setDeleted($deleted) {
        $this->deleted = $deleted;
        
        return $this;
    }
    
    /**
     * Is $hidden
     * 
     * @return boolean
     */
    public function isHidden() {
        return $this->hidden;
    }
    
    /**
     * Set $hidden
     * 
     * @param boolean $hidden
     * @return Base
     */
    public function setHidden($hidden) {
        $this->hidden = $hidden;
        
        return $this;
    }

    /**
     * Get $updatedAt
     * 
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }
    
    /**
     * Set $updatedAt
     * 
     * @param \DateTime $updatedAt
     * @return Base
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
        
        return $this;
    }

    /**
     * Get $createdAt
     * 
     * @return \DateTime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    /**
     * Set $createdAt
     * 
     * @param \DateTime $createdAt
     * @return Base
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
        
        return $this;
    }
    
    /**
     * Set $id with Ramsey/Uuid
     * 
     * @return Base
     */
    protected function setIdWithRamsey() {
        $this->id = Uuid::uuid4();
        
        return $this;
    }
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps() {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() === NULL) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
    
    /**
     * Get array copy of object
     *
     * @return array
     */
    public function getArrayCopy() {
        return get_object_vars($this);
    }
}
