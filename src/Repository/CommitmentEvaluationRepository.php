<?php

namespace App\Repository;

use App\Entity\CommitmentEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommitmentEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommitmentEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommitmentEvaluation[]    findAll()
 * @method CommitmentEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommitmentEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommitmentEvaluation::class);
    }

//    /**
//     * @return CommitmentEvaluation[] Returns an array of CommitmentEvaluation objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommitmentEvaluation
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
