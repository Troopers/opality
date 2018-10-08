<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    use StateFullRepositoryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getAll($excludeDisabled = true) {
        $this->queryBuilder = $this->getInstance('u');
        if (true === $excludeDisabled) {
            $this->queryBuilder->andWhere('u.enabled = :enabled')
                ->setParameter('enabled', true);
        }

        return $this;
    }

    /**
     * @param bool $onlyLeaderInvolvements
     * @return QueryBuilder
     */
    public function joinResponsibilities($onlyLeaderInvolvements = false) {
        $this->getInstance('u')
            ->join('u.leaderInvolvements', 'l')->addSelect('l')
            ->leftJoin('l.responsibility', 'lr')->addSelect('lr')
                ->andWhere('lr.enabled = :lrEnabled')->setParameter('lrEnabled', true)
                ->addOrderBy('lr.criticality', 'desc');
        if (false === $onlyLeaderInvolvements) {
            $this->queryBuilder
                ->join('u.advisorInvolvements', 'a')->addSelect('a')
                ->leftJoin('a.responsibility', 'ar')->addSelect('ar')
                    ->andWhere('ar.enabled = :arEnabled')->setParameter('arEnabled', true)
                    ->addOrderBy('ar.criticality', 'desc');
        }

        return $this;
    }
}
