<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait NameTrait
{
    #[ORM\Column(length: 150)]
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}