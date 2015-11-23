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


    public function getListOfToday()
    {
        $today = date('Y-m-d');
        $qb = $this->_em->createQueryBuilder();
        $qb->select('q')
            ->from('\Application\Entity\Queue', 'q')
            ->join('q.patient', 'p')
            ->where(
                $qb->expr()->eq('q.workedDay', "'$today'")
            )
            ->andWhere('q.isWaiting = 1');
        $result = $qb->getQuery()->getResult();
        return $result;
    }

    public function getNext(){
        $today = date('Y-m-d');
        $qb = $this->_em->createQueryBuilder();
        $qb->select('q')
            ->from('\Application\Entity\Queue', 'q')
            ->join('q.patient', 'p')
            ->where(
                $qb->expr()->eq('q.workedDay', "'$today'")
            )
            ->andWhere('q.isWaiting = 1');
        $result = $qb->getQuery()->getResult()[0];
        return $result;
    }



}