<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EvaluationRepository")
 */
class Evaluation
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="objectiveEvaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommitmentEvaluation", mappedBy="evaluation", orphanRemoval=true)
     */
    private $commitmentEvaluations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjectiveEvaluation", mappedBy="evaluation", orphanRemoval=true)
     */
    private $objectiveEvaluations;

    public function __construct()
    {
        $this->commitmentEvaluations = new ArrayCollection();
        $this->objectiveEvaluations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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

    /**
     * @return Collection|CommitmentEvaluation[]
     */
    public function getCommitmentEvaluations(): Collection
    {
        return $this->commitmentEvaluations;
    }

    public function addCommitmentEvaluation(CommitmentEvaluation $commitmentEvaluation): self
    {
        if (!$this->commitmentEvaluations->contains($commitmentEvaluation)) {
            $this->commitmentEvaluations[] = $commitmentEvaluation;
            $commitmentEvaluation->setEvaluation($this);
        }

        return $this;
    }

    public function removeCommitmentEvaluation(CommitmentEvaluation $commitmentEvaluation): self
    {
        if ($this->commitmentEvaluations->contains($commitmentEvaluation)) {
            $this->commitmentEvaluations->removeElement($commitmentEvaluation);
            // set the owning side to null (unless already changed)
            if ($commitmentEvaluation->getEvaluation() === $this) {
                $commitmentEvaluation->setEvaluation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ObjectiveEvaluation[]
     */
    public function getObjectiveEvaluations(): Collection
    {
        return $this->objectiveEvaluations;
    }

    public function addObjectiveEvaluation(ObjectiveEvaluation $objectiveEvaluation): self
    {
        if (!$this->objectiveEvaluations->contains($objectiveEvaluation)) {
            $this->objectiveEvaluations[] = $objectiveEvaluation;
            $objectiveEvaluation->setEvaluation($this);
        }

        return $this;
    }

    public function removeObjectiveEvaluation(ObjectiveEvaluation $objectiveEvaluation): self
    {
        if ($this->objectiveEvaluations->contains($objectiveEvaluation)) {
            $this->objectiveEvaluations->removeElement($objectiveEvaluation);
            // set the owning side to null (unless already changed)
            if ($objectiveEvaluation->getEvaluation() === $this) {
                $objectiveEvaluation->setEvaluation(null);
            }
        }

        return $this;
    }
}
