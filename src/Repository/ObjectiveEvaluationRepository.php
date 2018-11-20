<?php

namespace App\Repository;

use App\Entity\ObjectiveEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ObjectiveEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjectiveEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjectiveEvaluation[]    findAll()
 * @method ObjectiveEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectiveEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ObjectiveEvaluation::class);
    }

//    /**
//     * @return ObjectiveEvaluation[] Returns an array of ObjectiveEvaluation objects
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
    public function findOneBySomeField($value): ?ObjectiveEvaluation
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
