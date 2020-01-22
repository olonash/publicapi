<?php

namespace App\Repository;

use App\Entity\CountryPhoneCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CountryPhoneCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountryPhoneCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountryPhoneCode[]    findAll()
 * @method CountryPhoneCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryPhoneCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountryPhoneCode::class);
    }

    // /**
    //  * @return CountryPhoneCode[] Returns an array of CountryPhoneCode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CountryPhoneCode
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
