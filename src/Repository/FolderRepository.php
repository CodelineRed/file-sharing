<?php
namespace App\Repository;

use App\Entity\Folder;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;

class FolderRepository extends EntityRepository {
    
    /**
     * Find files with file_included = FALSE
     * 
     * @param Folder $folder
     * @return boolean|Collection
     */
    public function findUniqueFiles(Folder $folder) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $qb->select('fi')
            ->from('App\Entity\File', 'fi')
            ->leftJoin('App\Entity\FileFolderJoin', 'ffj', 'WITH', 'ffj.file = fi.id')
            ->leftJoin('App\Entity\Folder', 'fo', 'WITH', 'ffj.folder = fo.id')
            ->where('fi.fileIncluded = 0')
            ->andWhere('fo.id = :foid')
            ->setParameter('foid', $folder->getId());
        
        return $qb->getQuery()->getResult();
    }
    
    /**
     * Find files with access = 3 and file_included = FALSE
     * 
     * @param Folder $folder
     * @return boolean|Collection
     */
    public function findPublicFiles(Folder $folder) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $qb->select('fi')
            ->from('App\Entity\File', 'fi')
            ->leftJoin('App\Entity\FileFolderJoin', 'ffj', 'WITH', 'ffj.file = fi.id')
            ->leftJoin('App\Entity\Folder', 'fo', 'WITH', 'ffj.folder = fo.id')
            ->where('fi.fileIncluded = 0')
            ->andWhere('fi.access = 3')
            ->andWhere('fo.id = :foid')
            ->setParameter('foid', $folder->getId());
        
        return $qb->getQuery()->getResult();
    }
}
