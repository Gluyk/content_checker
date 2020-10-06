<?php

namespace App\Repository;

use App\Entity\PageToCheck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageToCheck|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageToCheck|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageToCheck[]    findAll()
 * @method PageToCheck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageToCheckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageToCheck::class);
    }

    // /**
    //  * @return PageToCheck[] Returns an array of PageToCheck objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PageToCheck
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
