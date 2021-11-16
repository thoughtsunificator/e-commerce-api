<?php

namespace App\Repository;

use App\Entity\SellerItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SellerItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method SellerItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method SellerItem[]    findAll()
 * @method SellerItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SellerItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SellerItem::class);
    }

    // /**
    //  * @return SellerItem[] Returns an array of SellerItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SellerItem
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
