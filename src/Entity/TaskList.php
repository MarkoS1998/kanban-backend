<?php

namespace App\Entity;

use App\Repository\TaskListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskListRepository::class)]
class TaskList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $open_tasks = null;

    #[ORM\Column]
    private ?int $completed_tasks = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\Column]
    private ?bool $is_completed = null;

    #[ORM\Column]
    private ?bool $is_trashed = null;

    #[ORM\OneToMany(mappedBy: 'task_list', targetEntity: Task::class)]
    private Collection $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
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

    public function getOpenTasks(): ?int
    {
        return $this->open_tasks;
    }

    public function setOpenTasks(int $open_tasks): static
    {
        $this->open_tasks = $open_tasks;

        return $this;
    }

    public function getCompletedTasks(): ?int
    {
        return $this->completed_tasks;
    }

    public function setCompletedTasks(int $completed_tasks): static
    {
        $this->completed_tasks = $completed_tasks;

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

    public function isIsCompleted(): ?bool
    {
        return $this->is_completed;
    }

    public function setIsCompleted(bool $is_completed): static
    {
        $this->is_completed = $is_completed;

        return $this;
    }

    public function isIsTrashed(): ?bool
    {
        return $this->is_trashed;
    }

    public function setIsTrashed(bool $is_trashed): static
    {
        $this->is_trashed = $is_trashed;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): static
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setTaskList($this);
        }

        return $this;
    }

    public function removeTask(Task $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getTaskList() === $this) {
                $task->setTaskList(null);
            }
        }

        return $this;
    }
}
