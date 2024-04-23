<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ParticipationRepository::class)]
class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $userSession = null;

    #[ORM\ManyToMany(targetEntity: Question::class, inversedBy: 'participations')]
    private Collection $questions;

    #[ORM\ManyToMany(targetEntity: Answer::class, inversedBy: 'participations')]
    private Collection $selectedAnswers;

    #[ORM\OneToOne(inversedBy: 'participation', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->selectedAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserSession(): ?string
    {
        return $this->userSession;
    }

    public function setUserSession(?string $userSession): static
    {
        $this->userSession = $userSession;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        $this->questions->removeElement($question);

        return $this;
    }


    /**
     * @return Collection<int, Question>
     */
    public function getSelectedAnswers(): Collection
    {
        return $this->selectedAnswers;
    }

    public function addSelectedAnswer(Answer $answer): static
    {
        if (!$this->selectedAnswers->contains($answer)) {
            $this->selectedAnswers->add($answer);
        }

        return $this;
    }

    public function removeSelectedAnswer(Answer $answer): static
    {
        $this->selectedAnswers->removeElement($answer);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
