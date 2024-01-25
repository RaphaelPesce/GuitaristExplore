<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\SettingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Setting
{
    use CreatedAtTrait;
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $tone = null;

    #[ORM\ManyToOne(inversedBy: 'settings')]
    private ?Guitarist $guitarist = null;

    #[ORM\ManyToOne(inversedBy: 'settings')]
    private ?Material $material = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTone(): ?string
    {
        return $this->tone;
    }

    public function setTone(string $tone): static
    {
        $this->tone = $tone;

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

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): static
    {
        $this->material = $material;

        return $this;
    }
}
