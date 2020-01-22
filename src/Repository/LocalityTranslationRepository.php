<?php

namespace App\Repository;

use App\Entity\LocalityTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LocalityTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocalityTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocalityTranslation[]    findAll()
 * @method LocalityTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalityTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocalityTranslation::class);
    }

    // /**
    //  * @return LocalityTranslation[] Returns an array of LocalityTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LocalityTranslation
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
