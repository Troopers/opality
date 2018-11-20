<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjectiveEvaluationRepository")
 * @ORM\Table(name="evaluation_objective")
 */
class ObjectiveEvaluation
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objective", inversedBy="evaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objective;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $value;

    /**
     * @ORM\Column(type="DegreeConfidenceType", length=55, nullable=true)
     */
    private $confidence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evaluation", inversedBy="objectiveEvaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evaluation;

    public function __toString()
    {
        return (string) $this->getValue();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjective(): ?Objective
    {
        return $this->objective;
    }

    public function setObjective(?Objective $objective): self
    {
        $this->objective = $objective;

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
     * @return ObjectiveEvaluation
     */
    public function setConfidence($confidence)
    {
        $this->confidence = $confidence;
        return $this;
    }

    public function getEvaluation(): ?Evaluation
    {
        return $this->evaluation;
    }

    public function setEvaluation(?Evaluation $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }
}
