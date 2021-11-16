<?php

namespace App\Repository;

use App\Entity\UserMerchant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserMerchant|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMerchant|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMerchant[]    findAll()
 * @method UserMerchant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMerchantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMerchant::class);
    }

    // /**
    //  * @return UserMerchant[] Returns an array of UserMerchant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserMerchant
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
