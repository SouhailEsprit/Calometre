<?php

namespace App\Repository;

use App\Entity\Reponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reponse[]    findAll()
 * @method Reponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reponse::class);
    }
        public function getAllAnswers()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT  reclamation.id AS recId, reclamation.date, reclamation.email ,reclamation.message,reclamation.type, reponse.id AS repp  ,reponse.repondre_id, reponse.reponse FROM reclamation 
        LEFT JOIN reponse ON reponse.repondre_id = reclamation.id 
        UNION 
        SELECT  reclamation.id recId, reclamation.date,reclamation.message,reclamation.email , reclamation.type,reponse.id AS repp , reponse.repondre_id, reponse.reponse FROM reclamation 
        RIGHT JOIN reponse ON reponse.repondre_id = reclamation.id';

        // $query = $this->createQueryBuilder('rec')->addSelect('rep')->join('rec.id')->where('rec.id = rep.')

        $stmt = $conn->prepare($sql);
        $result =  $stmt->executeQuery();

        return $result->fetchAllAssociative();
    }

    // /**
    //  * @return Reponse[] Returns an array of Reponse objects
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
    public function findOneBySomeField($value): ?Reponse
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
