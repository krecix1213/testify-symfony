<?php

namespace App\Entity;

use App\Repository\ResultsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResultsRepository::class)
 * @ORM\Table(name="`results`")
 */
class Results
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
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $userIdFk;

    /**
     * @ORM\ManyToOne(targetEntity=Questions::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $questionIdFk;

    /**
     * @ORM\Column(type="integer")
     */
    private $answerInt;

    /**
     * @ORM\Column(type="text")
     */
    private $answerText;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $answerMultiCheck;

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

    public function getQuestionIdFk(): ?Questions
    {
        return $this->questionIdFk;
    }

    public function setQuestionIdFk(?Questions $questionIdFk): self
    {
        $this->questionIdFk = $questionIdFk;

        return $this;
    }

    public function getAnswerInt(): ?int
    {
        return $this->answerInt;
    }

    public function setAnswerInt(int $answerInt): self
    {
        $this->answerInt = $answerInt;

        return $this;
    }

    public function getAnswerText(): ?string
    {
        return $this->answerText;
    }

    public function setAnswerText(string $answerText): self
    {
        $this->answerText = $answerText;

        return $this;
    }

    public function isAnswerMultiCheck(): ?bool
    {
        return $this->answerMultiCheck;
    }

    public function setAnswerMultiCheck(?bool $answerMultiCheck): self
    {
        $this->answerMultiCheck = $answerMultiCheck;

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
