<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ResponsibilityRepository")
 */
class Responsibility
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
     * @ORM\Column(type="CriticalityType")
     */
    private $criticality;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LeaderInvolvement", mappedBy="responsibility", orphanRemoval=true, cascade={"persist"})
     */
    private $leaderInvolvements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdvisorInvolvement", mappedBy="responsibility", orphanRemoval=true, cascade={"persist"})
     */
    private $advisorInvolvements;

    public function __construct()
    {
        $this->leaderInvolvements = new ArrayCollection();
        $this->advisorInvolvements = new ArrayCollection();
    }

    /**
     * @return null|string
     */
    public function __toString()
    {
        return $this->getName();
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

    public function getCriticality(): ?string
    {
        return $this->criticality;
    }

    public function setCriticality(string $criticality): self
    {
        $this->criticality = $criticality;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return Collection|LeaderInvolvement[]
     */
    public function getLeaderInvolvements(): Collection
    {
        return $this->leaderInvolvements;
    }

    public function addLeaderInvolvement(LeaderInvolvement $leaderInvolvement): self
    {
        if (!$this->leaderInvolvements->contains($leaderInvolvement)) {
            $this->leaderInvolvements[] = $leaderInvolvement;
            $leaderInvolvement->setResponsibility($this);
        }

        return $this;
    }

    public function removeLeaderInvolvement(LeaderInvolvement $leaderInvolvement): self
    {
        if ($this->leaderInvolvements->contains($leaderInvolvement)) {
            $this->leaderInvolvements->removeElement($leaderInvolvement);
            // set the owning side to null (unless already changed)
            if ($leaderInvolvement->getResponsibility() === $this) {
                $leaderInvolvement->setResponsibility(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AdvisorInvolvement[]
     */
    public function getAdvisorInvolvements(): Collection
    {
        return $this->advisorInvolvements;
    }

    public function addAdvisorInvolvement(AdvisorInvolvement $advisorInvolvement): self
    {
        if (!$this->advisorInvolvements->contains($advisorInvolvement)) {
            $this->advisorInvolvements[] = $advisorInvolvement;
            $advisorInvolvement->setResponsibility($this);
        }

        return $this;
    }

    public function removeAdvisorInvolvement(AdvisorInvolvement $advisorInvolvement): self
    {
        if ($this->advisorInvolvements->contains($advisorInvolvement)) {
            $this->advisorInvolvements->removeElement($advisorInvolvement);
            // set the owning side to null (unless already changed)
            if ($advisorInvolvement->getResponsibility() === $this) {
                $advisorInvolvement->setResponsibility(null);
            }
        }

        return $this;
    }
}
