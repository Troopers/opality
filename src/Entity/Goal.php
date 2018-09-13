<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\GoalRepository")
 */
class Goal
{
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotNull(message="goal.measurable")
     */
    private $measurement;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotEqualTo(value="0", message="goal.attainable")
     */
    private $attainable;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\NotEqualTo(value="0", message="goal.ambitious")
     */
    private $ambitious;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CoreValue", inversedBy="goals")
     */
    private $coreValues;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accomplished;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $plannedDate;

    /**
     * @ORM\Column(type="RecurrenceType", nullable=true)
     */
    private $recurrence;

    public function __toString()
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->coreValues = new ArrayCollection();
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

    /**
     * @return Collection|CoreValue[]
     */
    public function getCoreValues(): Collection
    {
        return $this->coreValues;
    }

    public function addCoreValue(CoreValue $coreValue): self
    {
        if (!$this->coreValues->contains($coreValue)) {
            $this->coreValues[] = $coreValue;
        }

        return $this;
    }

    public function removeCoreValue(CoreValue $coreValue): self
    {
        if ($this->coreValues->contains($coreValue)) {
            $this->coreValues->removeElement($coreValue);
        }

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
}
