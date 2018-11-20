<?php

namespace App\Repository;

use App\Entity\Objective;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Objective|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objective|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objective[]    findAll()
 * @method Objective[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectiveRepository extends ServiceEntityRepository
{
    use StateFullRepositoryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Objective::class);
    }

    public function filterByUsers(array $users)
    {
        $qb = $this->getInstance('g');
        if (count($users) > 0) {
            $qb->join('g.users', 'u')->addSelect('u')
                ->andWhere('u.id IN (:users)')
                ->setParameter('users', $users)
            ;
        }

        return $this;
    }

    public function filterByTeam($teams)
    {
        $this->getInstance('g')
            ->join('g.teams', 't')->addSelect('t')
            ->andWhere('t.id IN (:teams)')
            ->setParameter('teams', $teams)
        ;

        return $this;
    }
}
