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
