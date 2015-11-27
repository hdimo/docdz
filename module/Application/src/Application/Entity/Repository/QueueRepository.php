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
            ->andWhere('q.isWaiting = 1')
            ->orderBy('q.createdDate', 'ASC');

        $result = $qb->getQuery()->getResult();
        return $result;
    }

    /**
     * @param array|null $params
     * @return mixed
     */
    public function getList(array $params = null)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('q')
            ->from('\Application\Entity\Queue', 'q');

        $dateTo = date('Y-m-d');
        if (isset($params['dateTo'])) {
            $dateTo = $params['dateTo'];
            unset($params['dateTo']);
        }

        $conditions = $qb->expr()->eq('q.workedDay', "'$dateTo'");
        if (isset($params['dateFrom'])) {
            $conditions = "q.workedDay BETWEEN {$params['dateFrom']} AND {$dateTo}";
            unset($params['dateFrom']);
        }
        $qb->where($conditions);

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