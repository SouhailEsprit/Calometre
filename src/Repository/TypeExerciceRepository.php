<?php

namespace App\Repository;

use App\Entity\TypeExercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Typeexercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Typeexercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Typeexercice[]    findAll()
 * @method Typeexercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Typeexercice::class);
    }

    // /**
    //  * @return Typeexercice[] Returns an array of Typeexercice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Typeexercice
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
