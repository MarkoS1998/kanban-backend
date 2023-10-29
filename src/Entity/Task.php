<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $is_completed = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start_on = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $due_on = null;

    #[ORM\ManyToMany(targetEntity: Label::class, inversedBy: 'tasks')]
    private Collection $labels;

    #[ORM\Column]
    private ?int $open_subtasks = null;

    #[ORM\Column]
    private ?int $comments_count = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'tasks')]
    private Collection $assignee;

    #[ORM\Column]
    private ?bool $is_important = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $completed_on = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?TaskList $task_list = null;

    public function __construct()
    {
        $this->labels = new ArrayCollection();
        $this->assignee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isIsCompleted(): ?bool
    {
        return $this->is_completed;
    }

    public function setIsCompleted(bool $is_completed): static
    {
        $this->is_completed = $is_completed;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getStartOn(): ?\DateTimeInterface
    {
        return $this->start_on;
    }

    public function setStartOn(?\DateTimeInterface $start_on): static
    {
        $this->start_on = $start_on;

        return $this;
    }

    public function getDueOn(): ?\DateTimeInterface
    {
        return $this->due_on;
    }

    public function setDueOn(?\DateTimeInterface $due_on): static
    {
        $this->due_on = $due_on;

        return $this;
    }

    /**
     * @return Collection<int, Label>
     */
    public function getLabels(): Collection
    {
        return $this->labels;
    }

    public function addLabel(Label $label): static
    {
        if (!$this->labels->contains($label)) {
            $this->labels->add($label);
        }

        return $this;
    }

    public function removeLabel(Label $label): static
    {
        $this->labels->removeElement($label);

        return $this;
    }

    public function getOpenSubtasks(): ?int
    {
        return $this->open_subtasks;
    }

    public function setOpenSubtasks(int $open_subtasks): static
    {
        $this->open_subtasks = $open_subtasks;

        return $this;
    }

    public function getCommentsCount(): ?int
    {
        return $this->comments_count;
    }

    public function setCommentsCount(int $comments_count): static
    {
        $this->comments_count = $comments_count;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAssignee(): Collection
    {
        return $this->assignee;
    }

    public function addAssignee(User $assignee): static
    {
        if (!$this->assignee->contains($assignee)) {
            $this->assignee->add($assignee);
        }

        return $this;
    }

    public function removeAssignee(User $assignee): static
    {
        $this->assignee->removeElement($assignee);

        return $this;
    }

    public function isIsImportant(): ?bool
    {
        return $this->is_important;
    }

    public function setIsImportant(bool $is_important): static
    {
        $this->is_important = $is_important;

        return $this;
    }

    public function getCompletedOn(): ?\DateTimeInterface
    {
        return $this->completed_on;
    }

    public function setCompletedOn(?\DateTimeInterface $completed_on): static
    {
        $this->completed_on = $completed_on;

        return $this;
    }

    public function getTaskList(): ?TaskList
    {
        return $this->task_list;
    }

    public function setTaskList(?TaskList $task_list): static
    {
        $this->task_list = $task_list;

        return $this;
    }
}
