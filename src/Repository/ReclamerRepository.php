<?php

namespace App\Repository;

use App\Entity\Reclamer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reclamer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reclamer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reclamer[]    findAll()
 * @method Reclamer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReclamerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reclamer::class);
    }

    // /**
    //  * @return Reclamer[] Returns an array of Reclamer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reclamer
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
