<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param string $typeCode
     * @param string $parentCode
     * @param string $languageCode
     * @return mixed
     */
    public function searchProduct($typeCode = '', $subTypeCode = '', $languageCode = 'fr')
    {
        $queryBuilder = $this->createQueryBuilder('p')->select();
        if ($typeCode) {
            $queryBuilder->andWhere('p.type =:_typeCode')
                ->setParameter('_typeCode', $typeCode);
        }

        if ($subTypeCode) {
            $queryBuilder->orWhere('p.subType =:_subTypeCode')
                ->setParameter('_subTypeCode', $subTypeCode);
        }

        $queryBuilder->innerJoin('p.translations', 'pt', 'WITH', "p.id = pt.product AND pt.locale = 'en'")
            ->andWhere('pt.locale =:_locale')
            ->setParameter('_locale', 'en');
        
//dd($queryBuilder->getQuery()->getSQL()); die;
        $result = $queryBuilder->getQuery()->getResult();

        return $result;
    }
}
