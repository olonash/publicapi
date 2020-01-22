<?php

namespace App\Repository;

use App\Entity\ProductTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\FetchMode;

/**
 * @method ProductTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductTranslation[]    findAll()
 * @method ProductTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductTranslation::class);
    }

    /**
     * @param int $fetchMode
     * @return array|\mixed[]
     */
    public function getTranslationCodeExistant($fetchMode = FetchMode::COLUMN)
    {
        $sql = 'select DISTINCT (locale) from product_translation';

        $query = $this->getEntityManager()->getConnection()->query($sql);
        $result = $query->fetchAll($fetchMode);

        return $result;
    }

    /**
     * Search product
     * @param string $typeCode
     * @param string $subTypeCode
     * @param string $languageCode
     * @return mixed
     */
    public function searchProduct($typeCode = '', $subTypeCode = '', $languageCode = 'fr')
    {
        $queryBuilder = $this->createQueryBuilder('pt')
            ->andWhere('pt.locale= :_languageCode')
            ->setParameter('_languageCode', $languageCode)
            ->innerJoin('pt.product', 'p', 'WITH', 'p.id = pt.product');
        if ($typeCode) {
            $queryBuilder->andWhere('p.type = :_typeCode')
                ->setParameter('_typeCode', $typeCode);
        }

        if ($subTypeCode) {
            $queryBuilder->andWhere('p.subType =:_subTypeCode')
                ->setParameter('_subTypeCode', $subTypeCode);
        }
        $result = $queryBuilder->getQuery()->getResult();

        return $result;
    }
}
