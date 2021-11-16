<?php

namespace App\Repository;

use App\Entity\MerchantShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MerchantShop|null find($id, $lockMode = null, $lockVersion = null)
 * @method MerchantShop|null findOneBy(array $criteria, array $orderBy = null)
 * @method MerchantShop[]    findAll()
 * @method MerchantShop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MerchantShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MerchantShop::class);
    }

    // /**
    //  * @return MerchantShop[] Returns an array of MerchantShop objects
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
    public function findOneBySomeField($value): ?MerchantShop
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
