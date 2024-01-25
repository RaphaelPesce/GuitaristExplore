<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

trait ParagraphTrait
{
    #[ORM\Column(type: Types::TEXT)]
    private ?string $paragraph = null;

    public function getParagraph(): ?string
    {
        return $this->paragraph;
    }

    public function setParagraph(string $paragraph): static
    {
        $this->paragraph = $paragraph;

        return $this;
    }
}
