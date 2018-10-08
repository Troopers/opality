<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AdvisorInvolvementRepository")
 */
class AdvisorInvolvement extends Involvement
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Responsibility", inversedBy="advisorInvolvements")
     * @ORM\OrderBy({"criticality" = "DESC"})
     */
    private $responsibility;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="advisorInvolvements")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $user;

    public function getResponsibility(): ?Responsibility
    {
        return $this->responsibility;
    }

    public function setResponsibility(?Responsibility $responsibility): self
    {
        $this->responsibility = $responsibility;

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
