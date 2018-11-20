<?php

namespace App\Repository;

use App\Entity\Kuky;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Kuky|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kuky|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kuky[]    findAll()
 * @method Kuky[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KukyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Kuky::class);
    }

//    /**
//     * @return Kuky[] Returns an array of Kuky objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kuky
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
