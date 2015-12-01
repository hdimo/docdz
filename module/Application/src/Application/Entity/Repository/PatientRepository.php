<?php
/**
 * User: khaled
 * Date: 11/23/15 at 3:04 PM
 */

namespace Application\Entity\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class PatientRepository extends EntityRepository
{
    public function getList($name = null)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p')
            ->from('\Application\Entity\Patient', 'p')
            ->where('p.lastname LIKE :lastname')
            ->setParameter('lastname', '%'.$name.'%');
        $result = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return $result;
    }
}