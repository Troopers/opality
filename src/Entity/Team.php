<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
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
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="teams")
     */
    private $members;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Team", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Objective", mappedBy="teams")
     */
    private $objectives;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->children = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(User $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
        }

        return $this;
    }

    public function removeMember(User $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(Team $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(Team $child): self
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
     * @return Team|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Team $parent
     * @return Team
     */
    public function setParent($parent): ?self
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
            $objective->addTeam($this);
        }

        return $this;
    }

    public function removeObjective(Objective $objective): self
    {
        if ($this->objectives->contains($objective)) {
            $this->objectives->removeElement($objective);
            $objective->removeTeam($this);
        }

        return $this;
    }
}
