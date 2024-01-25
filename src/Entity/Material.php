<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\NameTrait;
use App\Entity\Trait\PictureTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Material
{
    use NameTrait;
    use PictureTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $category = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'material', targetEntity: Setting::class)]
    private Collection $settings;

    #[ORM\ManyToMany(targetEntity: Guitarist::class, mappedBy: 'material')]
    private Collection $guitarists;

    public function __construct()
    {
        $this->settings = new ArrayCollection();
        $this->guitarists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Setting>
     */
    public function getSettings(): Collection
    {
        return $this->settings;
    }

    public function addSetting(Setting $setting): static
    {
        if (!$this->settings->contains($setting)) {
            $this->settings->add($setting);
            $setting->setMaterial($this);
        }

        return $this;
    }

    public function removeSetting(Setting $setting): static
    {
        if ($this->settings->removeElement($setting)) {
            // set the owning side to null (unless already changed)
            if ($setting->getMaterial() === $this) {
                $setting->setMaterial(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Guitarist>
     */
    public function getGuitarists(): Collection
    {
        return $this->guitarists;
    }

    public function addGuitarist(Guitarist $guitarist): static
    {
        if (!$this->guitarists->contains($guitarist)) {
            $this->guitarists->add($guitarist);
            $guitarist->addMaterial($this);
        }

        return $this;
    }

    public function removeGuitarist(Guitarist $guitarist): static
    {
        if ($this->guitarists->removeElement($guitarist)) {
            $guitarist->removeMaterial($this);
        }

        return $this;
    }
}
