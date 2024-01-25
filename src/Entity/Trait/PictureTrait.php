<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait PictureTrait
{
    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }
}
