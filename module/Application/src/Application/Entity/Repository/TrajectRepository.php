<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 5/4/15
 * Time: 11:13 AM
 */

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;


class PatientRepository extends EntityRepository
{



    protected $conditions;

    /**
     * get paged list of traject based on criteria
     *
     * @param $offset
     * @param $limit
     * @param null $conditions
     * @return Paginator
     */
    public function getPagedList($offset, $limit, $conditions = [])
    {
        $this->conditions = $conditions;
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('t')
            ->from('\Application\Entity\Traject', 't')
            ->join('t.driver', 'u')
            ->orderBy('t.price')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->where('t.isEnabled = 1');

        //if(count($conditions) > 0)
        $qb = $this->filter($qb);
        $query = $qb->getQuery();
        $paginator = new Paginator($query);
        return $paginator;
    }


    /**
     * get Max and Min Price
     *
     * @return array
     */
    public function getMaxAndMinPrice()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('MAX(t.price) as maxPrice, MIN(t.price) as minPrice')
            ->from('\Application\Entity\Traject', 't')
            ->where('t.isEnabled = 1');
        $qb = $this->filter($qb);
        return $qb->getQuery()->getResult();
    }

    /**
     * Filter criteria
     *
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    protected function filter(QueryBuilder &$qb)
    {
        //filter by date
        if (!isset($this->conditions['date']))
            $this->conditions['date'] = date(self::DATE_FORMAT);

        if (isset($this->conditions['time']) && preg_match('/[0-9]{2}:[0-9]{2}/', $this->conditions['time'])) {

            $date = \DateTime::createFromFormat(self::DATE_TIME_FORMAT, "{$this->conditions['date']}{$this->conditions['time']}");
            $datetime = $date->getTimestamp();
            $qb->andWhere("t.date_time = {$datetime}");
            unset($this->conditions['time']);

        } elseif (isset($this->conditions['timeFrom']) && isset($this->conditions['timeTo'])) {

            $dateFrom = \DateTime::createFromFormat(self::DATE_TIME_FORMAT, "{$this->conditions['date']}{$this->conditions['timeFrom']}");
            $datetimeFrom = $dateFrom->getTimestamp();
            $dateTo = \DateTime::createFromFormat(self::DATE_TIME_FORMAT, "{$this->conditions['date']}{$this->conditions['timeTo']}");
            $datetimeTo = $dateTo->getTimestamp();
            $qb->andWhere("t.date_time BETWEEN {$datetimeFrom} AND {$datetimeTo}");
            unset($this->conditions['timeFrom']);
            unset($this->conditions['timeTo']);
        } else {

            $date = \DateTime::createFromFormat(self::DATE_TIME_FORMAT, $this->conditions['date'] . '00:05');
            $datetime = $date->getTimestamp();
            $dayAfter = $datetime + self::SECOND_PER_DAY;
            //$qb->andWhere("t.date_time BETWEEN {$datetime} AND {$dayAfter}");
            $qb->andWhere("t.date_time > {$datetime}");
        }
        unset($this->conditions['date']);

        //filter by price  //TODO filtering by price capability
        /*
        if(isset($this->conditions['minPrice']) && !empty($this->conditions['minPrice'])){
            $qb->andWhere('t.price >= '.$this->conditions['minPrice']);
            unset($this->conditions['minPrice']);
        }
        if(isset($this->conditions['maxPrice']) && !empty($this->conditions['maxPrice'])){
            $qb->andWhere('t.price <= '.$this->conditions['maxPrice']);
            unset($this->conditions['maxPrice']);
        }
        */
        //filter by user criteria (experience, gender and rating)
        if(isset($this->conditions['experience'])){
            $qb->andWhere("u.experience >= {$this->conditions['experience']}");
            unset($this->conditions['experience']);
        }
        if(isset($this->conditions['gender'])){
            if( $this->conditions['gender'] != "0")
                $qb->andWhere("u.gender = '{$this->conditions['gender']}'");
            unset($this->conditions['gender']);
        }

        //apply other filter (where field = value)
        if(is_array($this->conditions) && count($this->conditions) > 0 ){
            foreach($this->conditions as $key=>$value) {
                if($value){
                    $v = is_int($value) ? (int)$value : "'{$value}'" ;
                    $qb->andWhere("t.{$key} = {$v}");
                }
            }
        }

        return $qb;
    }
}