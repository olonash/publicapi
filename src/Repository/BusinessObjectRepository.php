<?php

namespace App\Repository;

use App\Entity\BusinessObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BusinessObject|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessObject|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessObject[]    findAll()
 * @method BusinessObject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessObjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessObject::class);
    }

    // /**
    //  * @return BusinessObject[] Returns an array of BusinessObject objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BusinessObject
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
