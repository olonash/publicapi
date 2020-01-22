<?php

namespace App\Repository;

use App\Entity\LocalityTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\FetchMode;

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

    /**
     * @param string $typeCode
     * @param string $parentCode
     * @param string $languageCode
     * @return mixed
     */
    public function findFilter($typeCode = '', $parentCode = '', $languageCode = 'fr')
    {

        $queryBuilder = $this->createQueryBuilder('lt')
            ->join('lt.locality', 'l');
        //si typeCode est vide ou null, on reccupere tous les locality
        if ($typeCode) {
            $queryBuilder->andWhere('l.typeCode = :_typeCode')
                ->setParameter('_typeCode', $typeCode);
        }

        $queryBuilder->andWhere('lt.locale= :_languageCode')
            ->setParameter('_languageCode', $languageCode);

        //parent code
        if ($parentCode) {
            $queryBuilder->join('l.parent', 'p');
            $queryBuilder->andWhere('p.code = :_parentCode')
                ->setParameter('_parentCode', $parentCode);
        }

        $result = $queryBuilder->getQuery()->getResult();

        return $result;
        ;
    }

    /**
     * @param int $fetchMode
     * @return array|\mixed[]
     */
    public function getTranslationCodeExistant($fetchMode = FetchMode::COLUMN)
    {
        $sql = 'select DISTINCT (locale) from locality_translation';

        $query = $this->getEntityManager()->getConnection()->query($sql);
        $result = $query->fetchAll($fetchMode);

        return $result;
    }
}
