<?php
namespace App\Entity;

use App\MappedSuperclass\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_role")
 */
class Role extends Base {
    
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;
    
    /**
     * One Role has many Users.
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
     * @return Role
     */
    public function setName($name) {
        $this->name = strtolower(trim($name));
        
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