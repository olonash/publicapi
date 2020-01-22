<?php

namespace App\Repository;

use App\Entity\MasterParameterValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MasterParameterValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method MasterParameterValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method MasterParameterValue[]    findAll()
 * @method MasterParameterValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MasterParameterValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MasterParameterValue::class);
    }

    // /**
    //  * @return MasterParameterValue[] Returns an array of MasterParameterValue objects
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
    public function findOneBySomeField($value): ?MasterParameterValue
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
