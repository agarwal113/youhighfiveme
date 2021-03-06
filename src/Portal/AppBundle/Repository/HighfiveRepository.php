<?php

namespace Portal\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Portal\UserBundle\Entity\User;

/**
 * HighfiveRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HighfiveRepository extends EntityRepository
{
    public function getLatestHighfivesForPublicEvents($limit = null)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b, c')
            ->leftJoin('b.event', 'c')
            ->addOrderBy('b.created', 'DESC')
            ->andWhere('c.isPublic = ?1')
            ->setParameter('1', '1');

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
            ->getResult();
    }
}
