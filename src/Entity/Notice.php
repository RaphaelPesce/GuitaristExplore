<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Repository\NoticeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoticeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Notice
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'notices')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'notices')]
    private ?Guitarist $guitarist = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

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

    public function getGuitarist(): ?Guitarist
    {
        return $this->guitarist;
    }

    public function setGuitarist(?Guitarist $guitarist): static
    {
        $this->guitarist = $guitarist;

        return $this;
    }
}
