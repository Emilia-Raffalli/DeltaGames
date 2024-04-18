<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $questionText = null;

    /**
     * @var Collection<int, Answer>
     */
    #[ORM\OneToMany(targetEntity: Answer::class, mappedBy: 'question')]
    private Collection $answers;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $hint = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Quiz $quiz = null;

    /**
     * @var Collection<int, Participation>
     */
    #[ORM\ManyToMany(targetEntity: Participation::class, mappedBy: 'question')]
    private Collection $participations;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Answer $answerChoice = null;

    #[ORM\Column(length: 255)]
    private ?string $correctAnswerDescription = null;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->participations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionText(): ?string
    {
        return $this->questionText;
    }

    public function setQuestionText(string $questionText): static
    {
        $this->questionText = $questionText;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): static
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): static
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    public function getHint(): ?string
    {
        return $this->hint;
    }

    public function setHint(string $hint): static
    {
        $this->hint = $hint;

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): static
    {
        $this->quiz = $quiz;

        return $this;
    }

    public function __toString(): string
    {
        return $this->questionText;
    }

    /**
     * @return Collection<int, Participation>
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): static
    {
        if (!$this->participations->contains($participation)) {
            $this->participations->add($participation);
            $participation->addQuestion($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): static
    {
        if ($this->participations->removeElement($participation)) {
            $participation->removeQuestion($this);
        }

        return $this;
    }

    public function getAnswerChoice(): ?Answer
    {
        return $this->answerChoice;
    }

    public function setAnswerChoice(?Answer $answerChoice): static
    {
        $this->answerChoice = $answerChoice;

        return $this;
    }

    public function getCorrectAnswerDescription(): ?string
    {
        return $this->correctAnswerDescription;
    }

    public function setCorrectAnswerDescription(string $correctAnswerDescription): static
    {
        $this->correctAnswerDescription = $correctAnswerDescription;

        return $this;
    }
}
