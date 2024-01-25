<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait UpdatedAtTrait
{
    private ?\DateTimeImmutable $updated_at = null;

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        if ($this->created_at === null) {
            $this->created_at = new \DateTimeImmutable();
        }
        if ($this->updated_at === null) {
            $this->updated_at = $this->created_at;
        }
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updated_at = new \DateTimeImmutable();
    }
}
