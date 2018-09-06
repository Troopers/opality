<?php

namespace App\Repository;

use App\Entity\Responsibility;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Responsibility|null find($id, $lockMode = null, $lockVersion = null)
 * @method Responsibility|null findOneBy(array $criteria, array $orderBy = null)
 * @method Responsibility[]    findAll()
 * @method Responsibility[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsibilityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Responsibility::class);
    }

//    /**
//     * @return Responsibility[] Returns an array of Responsibility objects
//     */
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
    public function findOneBySomeField($value): ?Responsibility
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
