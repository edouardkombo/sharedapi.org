<?php

namespace App\Repository;

use App\Entity\Independence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Independence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Independence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Independence[]    findAll()
 * @method Independence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndependenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Independence::class);
    }

    // /**
    //  * @return Independence[] Returns an array of Independence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Independence
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
