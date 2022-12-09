<?php
namespace App\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid as RUuid;

class BaseUuid extends Base {
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id;

    public function __construct() {
        if (!isset($this->id)) {
            $this->setIdWithRamsey();
        }
    }

    /**
     * Set $id with Ramsey/Uuid
     * 
     * @return Uuid
     */
    private function setIdWithRamsey() {
        $this->id = RUuid::uuid4();

        return $this;
    }
}
