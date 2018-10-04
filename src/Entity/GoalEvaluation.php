<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GoalEvaluationRepository")
 */
class GoalEvaluation
{
    use TimestampableEntity;

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
     * @ORM\Column(type="DegreeConfidenceType", length=55, nullable=true)
     */
    private $confidence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="goalEvaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __toString()
    {
        return (string) $this->getValue();
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

    /**
     * @return mixed
     */
    public function getConfidence()
    {
        return $this->confidence;
    }

    /**
     * @param mixed $confidence
     * @return GoalEvaluation
     */
    public function setConfidence($confidence)
    {
        $this->confidence = $confidence;
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
