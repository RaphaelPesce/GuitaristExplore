<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\SubmissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubmissionRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Submission
{
    use CreatedAtTrait;
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $table_name = null;

    #[ORM\Column]
    private array $data = [];

    #[ORM\Column(length: 100)]
    private ?string $status = 'en attente';

    #[ORM\ManyToOne(inversedBy: 'submissions')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTableName(): ?string
    {
        return $this->table_name;
    }

    public function setTableName(string $table_name): static
    {
        $this->table_name = $table_name;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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
}
