<?php
namespace App\Entity;

use App\MappedSuperclass\BaseUuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fs_recovery_code")
 */
class RecoveryCode extends BaseUuid {

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="recoveryCodes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * Encoded recovery code
     * 
     * @ORM\Column(type="string", options={"comment": "Encoded recovery code"})
     */
    private $code;

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
     * @return RecoveryCode
     */
    public function setUser($user) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get $code
     * 
     * @return string
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Set $code
     * 
     * @param string $code
     * @return RecoveryCode
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }
}