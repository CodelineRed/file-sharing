<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="imhhfs_file_type")
 */
class FileType extends \App\MappedSuperclass\LowerCaseUniqueName
{
    
    /**
     * @ORM\OneToMany(targetEntity="FileExtension", mappedBy="file_type")
     */
    private $fileExtensions;

    public function __construct() {
        $this->fileExtensions = new ArrayCollection();
    }
}