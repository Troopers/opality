<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource(
 *    collectionOperations={
 *        "get",
 *        "filterByObjectiveUsers"={
 *            "method"="GET",
 *            "route_name"="api_coreValue_filterByObjectiveUsersOrTeams",
 *            "controller"=APICoreValueController::class
 *        }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CoreValueRepository")
 */
class CoreValue
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mantra;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commitment", mappedBy="coreValues")
     */
    private $commitments;

    public function __construct()
    {
        $this->commitments = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getMantra(): ?string
    {
        return $this->mantra;
    }

    public function setMantra(?string $mantra): self
    {
        $this->mantra = $mantra;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
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
            $commitment->addCoreValue($this);
        }

        return $this;
    }

    public function removeCommitment(Commitment $commitment): self
    {
        if ($this->commitments->contains($commitment)) {
            $this->commitments->removeElement($commitment);
            $commitment->removeCoreValue($this);
        }

        return $this;
    }
}
