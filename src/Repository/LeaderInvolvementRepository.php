<?php

namespace App\Repository;

use App\Entity\LeaderInvolvement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LeaderInvolvement|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeaderInvolvement|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeaderInvolvement[]    findAll()
 * @method LeaderInvolvement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeaderInvolvementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LeaderInvolvement::class);
    }

//    /**
//     * @return LeaderInvolvement[] Returns an array of LeaderInvolvement objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LeaderInvolvement
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
