<?php

namespace App\Repository;

use App\Entity\CartProd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CartProd|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartProd|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartProd[]    findAll()
 * @method CartProd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartProdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartProd::class);
    }

    // /**
    //  * @return CartProd[] Returns an array of CartProd objects
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
    public function findOneBySomeField($value): ?CartProd
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
