<?php
namespace App\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class is used for Many-To-Many Entities
 * 
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
class BaseJoin {

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
     * @return BaseJoin
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
     * @return BaseJoin
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

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