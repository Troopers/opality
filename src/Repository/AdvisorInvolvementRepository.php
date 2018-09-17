<?php

namespace App\Repository;

use App\Entity\AdvisorInvolvement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AdvisorInvolvement|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdvisorInvolvement|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdvisorInvolvement[]    findAll()
 * @method AdvisorInvolvement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvisorInvolvementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AdvisorInvolvement::class);
    }

//    /**
//     * @return AdvisorInvolvement[] Returns an array of AdvisorInvolvement objects
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
    public function findOneBySomeField($value): ?AdvisorInvolvement
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
