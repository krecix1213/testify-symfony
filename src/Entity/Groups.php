<?php

namespace App\Entity;

use App\Repository\GroupsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupsRepository::class)
 * @ORM\Table(name="`groups`")
 */
class Groups
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ExamUsers::class, mappedBy="groupIdFk")
     */
    private $examUsers;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ts;

    public function __construct()
    {
        $this->examUsers = new ArrayCollection();
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
     * @return Collection<int, ExamUsers>
     */
    public function getExamUsers(): Collection
    {
        return $this->examUsers;
    }

    public function addExamUser(ExamUsers $examUser): self
    {
        if (!$this->examUsers->contains($examUser)) {
            $this->examUsers[] = $examUser;
            $examUser->setGroupIdFk($this);
        }

        return $this;
    }

    public function removeExamUser(ExamUsers $examUser): self
    {
        if ($this->examUsers->removeElement($examUser)) {
            // set the owning side to null (unless already changed)
            if ($examUser->getGroupIdFk() === $this) {
                $examUser->setGroupIdFk(null);
            }
        }

        return $this;
    }

    public function getTs(): ?\DateTimeInterface
    {
        return $this->ts;
    }

    public function setTs(\DateTimeInterface $ts): self
    {
        $this->ts = $ts;

        return $this;
    }
}
