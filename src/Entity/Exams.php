<?php

namespace App\Entity;

use App\Repository\ExamsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExamsRepository::class)
 * @ORM\Table(name="`exams`")
 */
class Exams
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
     * @ORM\Column(type="integer",  nullable=true, options={"default" : 0})
     */
    private $time;

    /**
     * @ORM\Column(type="boolean",  nullable=true, options={"default" : false})
     */
    private $random;

    /**
     * @ORM\Column(type="integer",  nullable=true, options={"default" : 0})
     */
    private $xOFy;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default" : false})
     */
    private $progressive;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default" : false})
     */
    private $rulesPage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $rulesPageText;

    /**
     * @ORM\OneToMany(targetEntity=Questions::class, mappedBy="examIdFk", orphanRemoval=true)
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity=Expires::class, mappedBy="examIdFk", orphanRemoval=true)
     */
    private $expires;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ts;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->expires = new ArrayCollection();
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

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function isRandom(): ?bool
    {
        return $this->random;
    }

    public function setRandom(bool $random): self
    {
        $this->random = $random;

        return $this;
    }

    public function getXOFy(): ?int
    {
        return $this->xOFy;
    }

    public function setXOFy(int $xOFy): self
    {
        $this->xOFy = $xOFy;

        return $this;
    }

    public function isProgressive(): ?bool
    {
        return $this->progressive;
    }

    public function setProgressive(bool $progressive): self
    {
        $this->progressive = $progressive;

        return $this;
    }

    public function isRulesPage(): ?bool
    {
        return $this->rulesPage;
    }

    public function setRulesPage(bool $rulesPage): self
    {
        $this->rulesPage = $rulesPage;

        return $this;
    }

    public function getRulesPageText(): ?string
    {
        return $this->rulesPageText;
    }

    public function setRulesPageText(?string $rulesPageText): self
    {
        $this->rulesPageText = $rulesPageText;

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setExamIdFk($this);
        }

        return $this;
    }

    public function removeQuestion(Questions $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getExamIdFk() === $this) {
                $question->setExamIdFk(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Expires>
     */
    public function getExpires(): Collection
    {
        return $this->expires;
    }

    public function addExpire(Expires $expire): self
    {
        if (!$this->expires->contains($expire)) {
            $this->expires[] = $expire;
            $expire->setExamIdFk($this);
        }

        return $this;
    }

    public function removeExpire(Expires $expire): self
    {
        if ($this->expires->removeElement($expire)) {
            // set the owning side to null (unless already changed)
            if ($expire->getExamIdFk() === $this) {
                $expire->setExamIdFk(null);
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
