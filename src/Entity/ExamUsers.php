<?php

namespace App\Entity;

use App\Repository\ExamUsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExamUsersRepository::class)
 * * @ORM\Table(name="`examsUsers`")
 */
class ExamUsers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Exams::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $examIdFk;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="examUsers")
     */
    private $userIdFk;

    /**
     * @ORM\ManyToOne(targetEntity=Groups::class, inversedBy="examUsers")
     */
    private $groupIdFk;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExamIdFk(): ?Exams
    {
        return $this->examIdFk;
    }

    public function setExamIdFk(?Exams $examIdFk): self
    {
        $this->examIdFk = $examIdFk;

        return $this;
    }

    public function getUserIdFk(): ?User
    {
        return $this->userIdFk;
    }

    public function setUserIdFk(?User $userIdFk): self
    {
        $this->userIdFk = $userIdFk;

        return $this;
    }

    public function getGroupIdFk(): ?Groups
    {
        return $this->groupIdFk;
    }

    public function setGroupIdFk(?Groups $groupIdFk): self
    {
        $this->groupIdFk = $groupIdFk;

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
