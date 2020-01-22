<?php

namespace App\Repository;

use App\Entity\MasterParameterValueTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MasterParameterValueTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MasterParameterValueTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MasterParameterValueTranslation[]    findAll()
 * @method MasterParameterValueTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MasterParameterValueTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MasterParameterValueTranslation::class);
    }

    // /**
    //  * @return MasterParameterValueTranslation[] Returns an array of MasterParameterValueTranslation objects
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
    public function findOneBySomeField($value): ?MasterParameterValueTranslation
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
