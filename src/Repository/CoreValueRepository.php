<?php

namespace App\Repository;

use App\Entity\CoreValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CoreValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoreValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoreValue[]    findAll()
 * @method CoreValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoreValueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CoreValue::class);
    }

//    /**
//     * @return CoreValue[] Returns an array of CoreValue objects
//     */
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
    public function findOneBySomeField($value): ?CoreValue
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
