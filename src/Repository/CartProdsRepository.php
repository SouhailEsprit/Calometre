<?php

namespace App\Repository;

use App\Entity\CartProds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CartProds|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartProds|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartProds[]    findAll()
 * @method CartProds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartProdsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartProds::class);
    }

    // /**
    //  * @return CartProds[] Returns an array of CartProds objects
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
    public function findOneBySomeField($value): ?CartProds
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
