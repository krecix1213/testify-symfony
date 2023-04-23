<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 * @ORM\Table(name="`questions`")
 */
class Questions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Exams::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $examIdFk;

    /**
     * @ORM\Column(type="integer")
     */
    private $questionType;

    /**
     * @ORM\Column(type="integer")
     */
    private $questionNumber;

    /**
     * @ORM\Column(type="text")
     */
    private $questionTitle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $answerCorrect;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $answerCorrectMulti;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ts;

    /**
     * @ORM\OneToMany(targetEntity=Answers::class, mappedBy="questionId", orphanRemoval=true)
     */
    private $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

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

    public function getQuestionType(): ?int
    {
        return $this->questionType;
    }

    public function setQuestionType(int $questionType): self
    {
        $this->questionType = $questionType;

        return $this;
    }

    public function getQuestionNumber(): ?int
    {
        return $this->questionNumber;
    }

    public function setQuestionNumber(int $questionNumber): self
    {
        $this->questionNumber = $questionNumber;

        return $this;
    }

    public function getQuestionTitle(): ?string
    {
        return $this->questionTitle;
    }

    public function setQuestionTitle(string $questionTitle): self
    {
        $this->questionTitle = $questionTitle;

        return $this;
    }

    public function getAnswerCorrect(): ?int
    {
        return $this->answerCorrect;
    }

    public function setAnswerCorrect(int $answerCorrect): self
    {
        $this->answerCorrect = $answerCorrect;

        return $this;
    }

    public function isAnswerCorrectMulti(): ?bool
    {
        return $this->answerCorrectMulti;
    }

    public function setAnswerCorrectMulti(?bool $answerCorrectMulti): self
    {
        $this->answerCorrectMulti = $answerCorrectMulti;

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

    /**
     * @return Collection<int, Answers>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answers $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestionId($this);
        }

        return $this;
    }

    public function removeAnswer(Answers $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestionId() === $this) {
                $answer->setQuestionId(null);
            }
        }

        return $this;
    }
}
