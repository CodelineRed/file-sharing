<?php
namespace App\Entity;

use App\MappedSuperclass\Base;
use App\Utility\GeneralUtility;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fs_user")
 */
class User extends Base {

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;

    /**
     * Encoded password
     * 
     * @ORM\Column(type="string", options={"comment": "Encoded password"})
     */
    private $pass;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="users")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity="UploadLimit", inversedBy="users")
     * @ORM\JoinColumn(name="upload_limit_id", referencedColumnName="id", nullable=false)
     */
    private $uploadLimit;

    /**
     * 1 if 2FA is enabled
     * 
     * @ORM\Column(type="boolean", name="two_factor", options={"comment": "1 if 2FA is enabled"})
     */
    private $twoFactor = FALSE;

    /**
     * Secret for 2FA validation and authenticator app
     * 
     * @ORM\Column(type="string", name="two_factor_secret", options={"comment": "Secret for 2FA validation and authenticator app"})
     */
    private $twoFactorSecret = '';

    /**
     * @ORM\OneToMany(targetEntity="File", mappedBy="user", cascade={"persist", "remove"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity="Folder", mappedBy="user", cascade={"persist", "remove"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $folders;

    /**
     * One User has many RecoveryCodes.
     * 
     * @ORM\OneToMany(targetEntity="RecoveryCode", mappedBy="user", cascade={"persist", "remove"})
     */
    private $recoveryCodes;

    public function __construct() {
        $this->files = new ArrayCollection();
        $this->folders = new ArrayCollection();
        $this->recoveryCodes = new ArrayCollection();
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
     * @return User
     */
    public function setName($name) {
        $this->name = strtolower(trim($name));

        return $this;
    }

    /**
     * Get $pass
     * 
     * @return string
     */
    public function getPass() {
        return $this->pass;
    }

    /**
     * Set $pass
     * 
     * @param string $pass
     * @return User
     */
    public function setPass($pass) {
        $this->pass = GeneralUtility::encryptPassword($pass);

        return $this;
    }

    /**
     * Get $role
     * 
     * @return Role
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * Set $role
     * 
     * @param Role $role
     * @return User
     */
    public function setRole($role) {
        $this->role = $role;

        return $this;
    }

    /**
     * Get $uploadLimit
     * 
     * @return UploadLimit
     */
    public function getUploadLimit() {
        return $this->uploadLimit;
    }

    /**
     * Set $uploadLimit
     * 
     * @param UploadLimit $uploadLimit
     * @return User
     */
    public function setUploadLimit($uploadLimit) {
        $this->uploadLimit = $uploadLimit;

        return $this;
    }

    /**
     * Has $twoFactor
     * 
     * @return boolean
     */
    public function hasTwoFactor() {
        return $this->twoFactor;
    }

    /**
     * Set $twoFactor
     * 
     * @param boolean $twoFactor
     * @return User
     */
    public function setTwoFactor($twoFactor) {
        $this->twoFactor = $twoFactor;

        return $this;
    }

    /**
     * Get $twoFactorSecret
     * 
     * @return string
     */
    public function getTwoFactorSecret() {
        return $this->twoFactorSecret;
    }

    /**
     * Set $twoFactorSecret
     * 
     * @param string $twoFactorSecret
     * @return User
     */
    public function setTwoFactorSecret($twoFactorSecret) {
        $this->twoFactorSecret = $twoFactorSecret;

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
    public function getFolders() {
        return $this->folders;
    }

    /**
     * Get $recoveryCodes
     * 
     * @return PersistentCollection
     */
    public function getRecoveryCodes() {
        return $this->recoveryCodes;
    }
}
