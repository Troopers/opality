<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Assert\Length(max=4096)
     * @var string
     */
    private $plainPassword = null;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $enabled;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Meeting", mappedBy="guests")
     */
    private $meetings;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", mappedBy="members")
     */
    private $teams;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Objective", mappedBy="users")
     */
    private $objectives;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjectiveEvaluation", mappedBy="user")
     */
    private $objectiveEvaluations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Kuky", mappedBy="author")
     */
    private $givenKukies;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Kuky", mappedBy="targets")
     */
    private $receivedKukies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LeaderInvolvement", mappedBy="user")
     */
    private $leaderInvolvements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdvisorInvolvement", mappedBy="user")
     */
    private $advisorInvolvements;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UltimateGoal", mappedBy="user", cascade={"persist", "remove"})
     */
    private $ultimateGoal;

    public function __construct()
    {
        $this->meetings = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->objectives = new ArrayCollection();
        $this->objectiveEvaluations = new ArrayCollection();
        $this->givenKukies = new ArrayCollection();
        $this->receivedKukies = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getFullName();
    }

    public function getFullName(): string
    {
        return (string) $this->firstname . ' '. $this->lastname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        //just update password to force persistence and event to wake up
        $this->password = $plainPassword;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Meeting[]
     */
    public function getMeetings(): Collection
    {
        return $this->meetings;
    }

    public function addMeeting(Meeting $meeting): self
    {
        if (!$this->meetings->contains($meeting)) {
            $this->meetings[] = $meeting;
            $meeting->addGuest($this);
        }

        return $this;
    }

    public function removeMeeting(Meeting $meeting): self
    {
        if ($this->meetings->contains($meeting)) {
            $this->meetings->removeElement($meeting);
            $meeting->removeGuest($this);
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
            $team->addMember($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            $team->removeMember($this);
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
            $objective->addUser($this);
        }

        return $this;
    }

    public function removeObjective(Objective $objective): self
    {
        if ($this->objectives->contains($objective)) {
            $this->objectives->removeElement($objective);
            $objective->removeUser($this);
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
            $objectiveEvaluation->setUser($this);
        }

        return $this;
    }

    public function removeObjectiveEvaluation(ObjectiveEvaluation $objectiveEvaluation): self
    {
        if ($this->objectiveEvaluations->contains($objectiveEvaluation)) {
            $this->objectiveEvaluations->removeElement($objectiveEvaluation);
            // set the owning side to null (unless already changed)
            if ($objectiveEvaluation->getUser() === $this) {
                $objectiveEvaluation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Kuky[]
     */
    public function getGivenKukies(): Collection
    {
        return $this->givenKukies;
    }

    public function addGivenKuky(Kuky $givenKuky): self
    {
        if (!$this->givenKukies->contains($givenKuky)) {
            $this->givenKukies[] = $givenKuky;
            $givenKuky->setAuthor($this);
        }

        return $this;
    }

    public function removeGivenKuky(Kuky $givenKuky): self
    {
        if ($this->givenKukies->contains($givenKuky)) {
            $this->givenKukies->removeElement($givenKuky);
            // set the owning side to null (unless already changed)
            if ($givenKuky->getAuthor() === $this) {
                $givenKuky->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Kuky[]
     */
    public function getReceivedKukies(): Collection
    {
        return $this->receivedKukies;
    }

    public function addReceivedKuky(Kuky $receivedKuky): self
    {
        if (!$this->receivedKukies->contains($receivedKuky)) {
            $this->receivedKukies[] = $receivedKuky;
            $receivedKuky->addTarget($this);
        }

        return $this;
    }

    public function removeReceivedKuky(Kuky $receivedKuky): self
    {
        if ($this->receivedKukies->contains($receivedKuky)) {
            $this->receivedKukies->removeElement($receivedKuky);
            $receivedKuky->removeTarget($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLeaderInvolvements()
    {
        return $this->leaderInvolvements;
    }

    /**
     * @return mixed
     */
    public function getAdvisorInvolvements()
    {
        return $this->advisorInvolvements;
    }

    public function getUltimateGoal(): ?UltimateGoal
    {
        return $this->ultimateGoal;
    }

    public function setUltimateGoal(?UltimateGoal $ultimateGoal): self
    {
        $this->ultimateGoal = $ultimateGoal;

        return $this;
    }
}
