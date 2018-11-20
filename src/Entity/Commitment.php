<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CommitmentRepository")
 */
class Commitment
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CoreValue", inversedBy="commitments")
     */
    private $coreValues;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Objective", inversedBy="commitments")
     */
    private $objectives;

    public function __construct()
    {
        $this->coreValues = new ArrayCollection();
        $this->objectives = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getName();
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

    /**
     * @return Collection|Objective[]
     */
    public function getObjectives(): Collection
    {
        return $this->objectives;
    }

    public function addObjective(Objective $objective): self
    {
        if (!$this->objectives->contains($objective)) {
            $this->objectives[] = $objective;
        }

        return $this;
    }

    public function removeObjective(Objective $objective): self
    {
        if ($this->objectives->contains($objective)) {
            $this->objectives->removeElement($objective);
        }

        return $this;
    }
}
