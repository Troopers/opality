<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\LeaderInvolvementRepository")
 */
class LeaderInvolvement extends Involvement
{
    /**
     * @ORM\Column(type="CriticalityType")
     */
    private $mentalCharge;

    /**
     * @ORM\Column(type="CriticalityType")
     */
    private $timeConsumator;

    /**
     * @ORM\Column(type="CriticalityType")
     */
    private $anxiety;

    /**
     * @ORM\Column(type="CriticalityType")
     */
    private $palatability;

    /**
     * @ORM\Column(type="CriticalityType")
     */
    private $toughness;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Responsibility", inversedBy="leaderInvolvements")
     */
    private $responsibility;

    public function getMentalCharge(): ?string
    {
        return $this->mentalCharge;
    }

    public function setMentalCharge(string $mentalCharge): self
    {
        $this->mentalCharge = $mentalCharge;

        return $this;
    }

    public function getTimeConsumator(): ?string
    {
        return $this->timeConsumator;
    }

    public function setTimeConsumator(string $timeConsumator): self
    {
        $this->timeConsumator = $timeConsumator;

        return $this;
    }

    public function getAnxiety(): ?string
    {
        return $this->anxiety;
    }

    public function setAnxiety(string $anxiety): self
    {
        $this->anxiety = $anxiety;

        return $this;
    }

    public function getPalatability(): ?string
    {
        return $this->palatability;
    }

    public function setPalatability(string $palatability): self
    {
        $this->palatability = $palatability;

        return $this;
    }

    public function getToughness(): ?string
    {
        return $this->toughness;
    }

    public function setToughness(string $toughness): self
    {
        $this->toughness = $toughness;

        return $this;
    }

    public function getResponsibility(): ?Responsibility
    {
        return $this->responsibility;
    }

    public function setResponsibility(?Responsibility $responsibility): self
    {
        $this->responsibility = $responsibility;

        return $this;
    }
}
