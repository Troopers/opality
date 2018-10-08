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

    public function findWithInvolvements()
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.leaderInvolvements', 'l')->addSelect('l')
            ->leftJoin('r.advisorInvolvements', 'a')->addSelect('a')
            ->addOrderBy('r.criticality', 'DESC')
            ->getQuery()->getResult();

    }
}
