<?php

namespace App\Entity;

use App\Repository\MultiAnswersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MultiAnswersRepository::class)
 * @ORM\Table(name="`multiAnswer`")
 */
class MultiAnswers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $userIdFk;

    /**
     * @ORM\Column(type="integer")
     */
    private $answer;

    /**
     * @ORM\ManyToOne(targetEntity=Exams::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $examIdFk;

    /**
     * @ORM\ManyToOne(targetEntity=Questions::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $questionIdFk;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ts;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAnswer(): ?int
    {
        return $this->answer;
    }

    public function setAnswer(int $answer): self
    {
        $this->answer = $answer;

        return $this;
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

    public function getQuestionIdFk(): ?Questions
    {
        return $this->questionIdFk;
    }

    public function setQuestionIdFk(?Questions $questionIdFk): self
    {
        $this->questionIdFk = $questionIdFk;

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
