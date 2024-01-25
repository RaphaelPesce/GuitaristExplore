<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait CreatedAtTrait
{
    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    #[ORM\PrePersist]
    public function prePersistCreatedAt(): void
    {
        if ($this->created_at === null) {
            $this->created_at = new \DateTimeImmutable();
        }
    }
}
