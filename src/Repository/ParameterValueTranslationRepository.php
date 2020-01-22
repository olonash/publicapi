<?php

namespace App\Repository;

use App\Entity\ParameterValueTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ParameterValueTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParameterValueTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParameterValueTranslation[]    findAll()
 * @method ParameterValueTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParameterValueTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParameterValueTranslation::class);
    }

    // /**
    //  * @return ParameterValueTranslation[] Returns an array of ParameterValueTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParameterValueTranslation
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
