<?php

namespace App\Repository;

use App\Entity\GoalEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GoalEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method GoalEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method GoalEvaluation[]    findAll()
 * @method GoalEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoalEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GoalEvaluation::class);
    }

//    /**
//     * @return GoalEvaluation[] Returns an array of GoalEvaluation objects
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
    public function findOneBySomeField($value): ?GoalEvaluation
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
