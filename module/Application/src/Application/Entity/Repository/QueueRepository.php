<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 11/6/15
 * Time: 5:05 PM
 */

namespace Application\Entity\Repository;


use Application\Entity\Queue;
use Doctrine\ORM\EntityRepository;

class QueueRepository extends EntityRepository
{

    /**
     * @return array
     */

    public function getListOfToday(array $condition = null)
    {
        $today = date('Y-m-d');
        $qb = $this->_em->createQueryBuilder();
        $qb->select('q')
            ->from('\Application\Entity\Queue', 'q')
            ->join('q.patient', 'p')
            ->where(
                $qb->expr()->eq('q.workedDay', "'$today'")
            )
            ->orderBy('q.createdDate', 'ASC');
        if(is_array($condition)){
            foreach($condition as $field=>$value){
                if($value !== null)
                    $qb->andWhere("q.{$field} = {$value}");
            }
        }

        $result = $qb->getQuery()->getResult();
        return $result;
    }

    /**
     *
     *
     * @param array|null $params
     * @return mixed
     */
    public function getList(array $params = null)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('q')
            ->from('\Application\Entity\Queue', 'q');


        //if any other equal condition
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                $query = "q.{$key}={$value}";
                $qb->andWhere($query);
            }
        }
        $result = @$qb->getQuery()->getResult();
        return $result;
    }


}