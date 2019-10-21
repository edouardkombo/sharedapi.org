<?php

namespace App\Repository;

use App\Entity\Government;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Government|null find($id, $lockMode = null, $lockVersion = null)
 * @method Government|null findOneBy(array $criteria, array $orderBy = null)
 * @method Government[]    findAll()
 * @method Government[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GovernmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Government::class);
    }

    // /**
    //  * @return Government[] Returns an array of Government objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Government
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
