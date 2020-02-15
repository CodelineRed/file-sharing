<?php
namespace App\Repository;

use App\Utility\LanguageUtility;
use Doctrine\ORM\EntityRepository;

class AccessRepository extends EntityRepository {
    
    /**
     * Find all access states and convert to array
     * 
     * @return array
     */
    public function findAllArray() {
        $accessList = $this->getEntityManager()->getRepository('App\Entity\Access')->findAll();
        $result = [];
        
        foreach ($accessList as $access) {
            $result[] = [
                'id' => $access->getId(),
                'name' => $access->getName(),
                'icon' => $access->getIcon(),
                'button' => $access->getButton(),
                'trans' => LanguageUtility::trans($access->getName()),
            ];
        }
        
        return $result;
    }
}
