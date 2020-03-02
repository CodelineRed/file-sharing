<?php
namespace App\Repository;

use App\Entity\Access;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\PersistentCollection;

class UserRepository extends EntityRepository {

    /**
     * @return array|mixed
     */
//    public function findAll() {
//        $qb = $this->getEntityManager()->createQueryBuilder();
//        $qb2 = $this->getEntityManager()->createQueryBuilder();
//
//        $qb->select('u')
//            ->addSelect('(' . $qb2->select("COUNT(fi.id)")
//                ->from("App\Entity\File", "fi")
//                ->leftJoin('fi.user', 'u2', 'WITH', 'fi.user = u2.id')
//                ->where("fi.fileIncluded = 0")
//                ->groupBy('fi.fileIncluded')
//                ->getDQL() . ') AS uniqueFilesQuantity')
//            ->from('App\Entity\User', 'u');
//
//        return $qb->getQuery()->getResult();
//    }

    /**
     * Find files with file_included = FALSE
     * 
     * @param PersistentCollection $files
     * @return boolean|Collection
     */
    public function findUniqueFiles(PersistentCollection $files) {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('fileIncluded', FALSE))
            ->orderBy(['createdAt' => Criteria::DESC]);
        
        return $files->matching($criteria);
    }
    
    /**
     * Find files with access = 3 and file_included = FALSE
     * 
     * @param PersistentCollection $files
     * @return boolean|Collection
     */
    public function findPublicFiles(PersistentCollection $files) {
        $access = $this->getEntityManager()->getRepository('App\Entity\Access')->findOneBy(['id' => 3]);
        
        if ($access instanceof Access) {
            $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('access', $access))
                ->andWhere(Criteria::expr()->eq('fileIncluded', FALSE))
                ->orderBy(['createdAt' => Criteria::DESC]);

            return $files->matching($criteria);
        }
        
        return FALSE;
    }

    /**
     * Returns disk usage in bytes
     *
     * @param PersistentCollection $files
     * @return integer
     */
    public function getDiskUsage(PersistentCollection $files) {
        $diskUsage = 0;

        foreach ($files as $file) {
            $diskUsage += intval($file->getSize());
        }

        return $diskUsage;
    }
}
