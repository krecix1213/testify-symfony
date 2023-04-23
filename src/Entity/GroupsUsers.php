<?php

namespace App\Entity;

use App\Repository\GroupsUsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupsUsersRepository::class)
 * @ORM\Table(name="`groupsUsers`")
 */
class GroupsUsers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="groupsUsers")
     */
    private $userIdFk;

    /**
     * @ORM\ManyToMany(targetEntity=Groups::class)
     */
    private $groupIdFk;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ts;

    public function __construct()
    {
        $this->userIdFk = new ArrayCollection();
        $this->groupIdFk = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserIdFk(): Collection
    {
        return $this->userIdFk;
    }

    public function addUserIdFk(User $userIdFk): self
    {
        if (!$this->userIdFk->contains($userIdFk)) {
            $this->userIdFk[] = $userIdFk;
        }

        return $this;
    }

    public function removeUserIdFk(User $userIdFk): self
    {
        $this->userIdFk->removeElement($userIdFk);

        return $this;
    }

    /**
     * @return Collection<int, Groups>
     */
    public function getGroupIdFk(): Collection
    {
        return $this->groupIdFk;
    }

    public function addGroupIdFk(Groups $groupIdFk): self
    {
        if (!$this->groupIdFk->contains($groupIdFk)) {
            $this->groupIdFk[] = $groupIdFk;
        }

        return $this;
    }

    public function removeGroupIdFk(Groups $groupIdFk): self
    {
        $this->groupIdFk->removeElement($groupIdFk);

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
