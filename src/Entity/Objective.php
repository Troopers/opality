<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *    collectionOperations={
 *        "get",
 *        "filterByUsers"={
 *            "method"="GET",
 *            "route_name"="api_objective_filterByUser",
 *            "controller"=APIObjectiveController::class
 *        }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ObjectiveRepository")
 */
class Objective
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotNull(message="objective.measurable")
     */
    private $measurement;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotEqualTo(value="0", message="objective.attainable")
     */
    private $attainable;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\NotEqualTo(value="0", message="objective.ambitious")
     */
    private $ambitious;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accomplished = false;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $plannedDate;

    /**
     * @ORM\Column(type="RecurrenceType", nullable=true)
     */
    private $recurrence;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjectiveEvaluation", mappedBy="objective", orphanRemoval=true)
     */
    private $evaluations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Responsibility", mappedBy="objectives")
     */
    private $responsibilities;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objective", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objective", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="objectives")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", inversedBy="objectives")
     */
    private $teams;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commitment", mappedBy="objectives")
     */
    private $commitments;

    public function __toString()
    {
        return (string) $this->getName();
    }

    public function __construct()
    {
        $this->evaluations = new ArrayCollection();
        $this->responsibilities = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->commitments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMeasurement(): ?string
    {
        return $this->measurement;
    }

    public function setMeasurement(?string $measurement): self
    {
        $this->measurement = $measurement;

        return $this;
    }

    public function getAttainable(): ?bool
    {
        return $this->attainable;
    }

    public function setAttainable(bool $attainable): self
    {
        $this->attainable = $attainable;

        return $this;
    }

    public function getAmbitious(): ?bool
    {
        return $this->ambitious;
    }

    public function setAmbitious(?bool $ambitious): self
    {
        $this->ambitious = $ambitious;

        return $this;
    }

    public function getAccomplished(): ?bool
    {
        return $this->accomplished;
    }

    public function setAccomplished(bool $accomplished): self
    {
        $this->accomplished = $accomplished;

        return $this;
    }

    public function getPlannedDate(): ?\DateTimeInterface
    {
        return $this->plannedDate;
    }

    public function setPlannedDate(?\DateTimeInterface $plannedDate): self
    {
        $this->plannedDate = $plannedDate;

        return $this;
    }

    public function getRecurrence()
    {
        return $this->recurrence;
    }

    public function setRecurrence($recurrence): self
    {
        $this->recurrence = $recurrence;

        return $this;
    }

    /**
     * @return Collection|ObjectiveEvaluation[]
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(ObjectiveEvaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setObjective($this);
        }

        return $this;
    }

    public function removeEvaluation(ObjectiveEvaluation $evaluation): self
    {
        if ($this->evaluations->contains($evaluation)) {
            $this->evaluations->removeElement($evaluation);
            // set the owning side to null (unless already changed)
            if ($evaluation->getObjective() === $this) {
                $evaluation->setObjective(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Responsibility[]
     */
    public function getResponsibilities(): Collection
    {
        return $this->responsibilities;
    }

    public function addResponsibility(Responsibility $responsibility): self
    {
        if (!$this->responsibilities->contains($responsibility)) {
            $this->responsibilities[] = $responsibility;
            $responsibility->addObjective($this);
        }

        return $this;
    }

    public function removeResponsibility(Responsibility $responsibility): self
    {
        if ($this->responsibilities->contains($responsibility)) {
            $this->responsibilities->removeElement($responsibility);
            $responsibility->removeObjective($this);
        }

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|Objective[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(Objective $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(Objective $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
        }

        return $this;
    }

    /**
     * @return Collection|Commitment[]
     */
    public function getCommitments(): Collection
    {
        return $this->commitments;
    }

    public function addCommitment(Commitment $commitment): self
    {
        if (!$this->commitments->contains($commitment)) {
            $this->commitments[] = $commitment;
            $commitment->addObjective($this);
        }

        return $this;
    }

    public function removeCommitment(Commitment $commitment): self
    {
        if ($this->commitments->contains($commitment)) {
            $this->commitments->removeElement($commitment);
            $commitment->removeObjective($this);
        }

        return $this;
    }
}
