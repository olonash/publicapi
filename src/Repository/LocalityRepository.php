<?php

namespace App\Repository;

use App\Entity\Locality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Locality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Locality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Locality[]    findAll()
 * @method Locality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Locality::class);
    }

    /**
     * @param string $typeCode
     * @param string $parentCode
     * @param string $languageCode
     * @return mixed
     */
    public function findWithFilter($typeCode = '', $parentCode = '', $languageCode = '')
    {

        $queryBuilder = $this->createQueryBuilder('l')
            ->andWhere('l.type_code = :_typeCode')
            ->setParameter('_typeCode', 'city')
            //->leftJoin('l.parent', 'p', 'WITH', 'p.id = :_parentCode')
            //->andWhere('l.parent= :_parentCode')
            //->setParameter('_parentCode', $parentCode)

            ->join('l.translations', 'lt', 'WITH', 'lt.locality= l.id')
            ->andWhere('lt.locale= :_languageCode')
            ->setParameter('_languageCode', 'fr');

        $result = $queryBuilder->getQuery()->getResult();
//dd(sizeof($result));
        return $result;
        ;
    }
}
