<?php

namespace App\Repository;

use App\Entity\UltimateGoal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UltimateGoal|null find($id, $lockMode = null, $lockVersion = null)
 * @method UltimateGoal|null findOneBy(array $criteria, array $orderBy = null)
 * @method UltimateGoal[]    findAll()
 * @method UltimateGoal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UltimateGoalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UltimateGoal::class);
    }

//    /**
//     * @return UltimateGoal[] Returns an array of UltimateGoal objects
//     */
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
    public function findOneBySomeField($value): ?UltimateGoal
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
