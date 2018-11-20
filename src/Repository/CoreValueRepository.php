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
    use StateFullRepositoryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CoreValue::class);
    }

    public function getAll() {
        $this->queryBuilder = $this->getInstance('coreValues');

        return $this;
    }

    /**
     * @return $this
     */
    public function joinCommitments($joinType = 'leftJoin') {
        $this->getInstance('coreValues')
            ->$joinType('coreValues.commitments', 'commitment')->addSelect('commitment');

        return $this;
    }

    /**
     * @return $this
     */
    public function joinObjectives($joinType = 'leftJoin') {
        $qb = $this->getInstance('coreValues');
        if (!in_array("commitment", $qb->getAllAliases())) {
            $this->joinCommitments($joinType);
        }
        $qb->$joinType('commitment.objectives', 'objective')->addSelect('objective');

        return $this;
    }

    /**
     * @return $this
     */
    public function joinUsers($joinType = 'leftJoin') {
        $qb = $this->getInstance('coreValues');
        if (!in_array("objective", $qb->getAllAliases())) {
            $this->joinObjectives($joinType);
        }
        $qb
            ->$joinType('objective.users', 'u')->addSelect('u');

        return $this;
    }

    /**
     * @return $this
     */
    public function joinTeams($joinType = 'leftJoin') {
        $qb = $this->getInstance('coreValues');
        if (!in_array("objective", $qb->getAllAliases())) {
            $this->joinObjectives($joinType);
        }
        $qb
            ->$joinType('objective.teams', 't')->addSelect('t')
            ->$joinType('t.members', 'tm')->addSelect('tm');

        return $this;
    }

    /**
     * @param array $users
     * @return $this
     */
    public function filterByUsers(array $users)
    {
        $qb = $this->getInstance('coreValues');
        if (count($users) > 0) {
            if (!in_array("u", $qb->getAllAliases())) {
                $this->joinUsers();
            }
            $qb
                ->orWhere('u.id IN (:users)')
                ->setParameter('users', $users)
            ;
        }

        return $this;
    }

    /**
     * @param $teams
     * @return $this
     */
    public function filterByTeams($teams)
    {
        $qb = $this->getInstance('coreValues');
        if (count($teams) > 0) {
            if (!in_array("t", $qb->getAllAliases())) {
                $this->joinTeams();
            }
            $qb
            ->orWhere('t.id IN (:teams)')
            ->setParameter('teams', $teams)
            ;
        }

        return $this;
    }
}
