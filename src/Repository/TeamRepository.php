<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Team|null find($id, $lockMode = null, $lockVersion = null)
 * @method Team|null findOneBy(array $criteria, array $orderBy = null)
 * @method Team[]    findAll()
 * @method Team[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamRepository extends ServiceEntityRepository
{
    use StateFullRepositoryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function getAll() {
        $this->queryBuilder = $this->getInstance('t');

        return $this;
    }
    /**
     * @return QueryBuilder
     */
    public function joinMembers($onlyEnabled = true) {
        $qb = $this->getInstance('t')
            ->join('t.members', 'm')->addSelect('m');
        if (true === $onlyEnabled) {
            $qb->andWhere('m.enabled = :enabled')->setParameter('enabled', true);
        }

        return $this;
    }
}
