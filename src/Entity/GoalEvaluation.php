<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GoalEvaluationRepository")
 */
class GoalEvaluation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Goal", inversedBy="evaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $goal;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $value;

    /**
     * @ORM\Column(type="boolean")
     */
    private $done;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="goalEvaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __toString()
    {
        return $this->getValue();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGoal(): ?Goal
    {
        return $this->goal;
    }

    public function setGoal(?Goal $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getDone(): ?bool
    {
        return $this->done;
    }

    public function setDone(bool $done): self
    {
        $this->done = $done;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
