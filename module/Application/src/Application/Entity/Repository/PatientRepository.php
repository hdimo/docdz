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
    /**
     * get list of patient base on name match
     *
     * @param null $name
     * @return array
     */
    public function getListByName($name = null)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p')
            ->from('\Application\Entity\Patient', 'p')
            ->where('p.lastname LIKE :lastname')
            ->setParameter('lastname', '%' . $name . '%');
        $result = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return $result;
    }


    public function getList(array $condition = null)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p')
            ->from('\Application\Entity\Patient', 'p');
        if ($condition) {
            foreach($condition as $field=>$value){
                if($value)
                    $qb->where("{$field} = {$value}");
            }
        }
        $result = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return $result;

    }
}