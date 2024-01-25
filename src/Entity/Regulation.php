<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\ParagraphTrait;
use App\Entity\Trait\PictureTrait;
use App\Entity\Trait\TitleTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\RegulationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegulationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Regulation
{
    use TitleTrait;
    use ParagraphTrait;
    use PictureTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'regulations')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
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
