<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\NameTrait;
use App\Entity\Trait\PictureTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\GuitaristRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuitaristRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Guitarist
{
    use NameTrait;
    use PictureTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $biography = null;

    #[ORM\ManyToOne(inversedBy: 'guitarists')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'guitarist', targetEntity: Notice::class)]
    private Collection $notices;

    #[ORM\OneToMany(mappedBy: 'guitarist', targetEntity: Setting::class)]
    private Collection $settings;

    #[ORM\ManyToMany(targetEntity: Material::class, inversedBy: 'guitarists')]
    private Collection $material;

    public function __construct()
    {
        $this->notices = new ArrayCollection();
        $this->settings = new ArrayCollection();
        $this->material = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): static
    {
        $this->biography = $biography;

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

    /**
     * @return Collection<int, Notice>
     */
    public function getNotices(): Collection
    {
        return $this->notices;
    }

    public function addNotice(Notice $notice): static
    {
        if (!$this->notices->contains($notice)) {
            $this->notices->add($notice);
            $notice->setGuitarist($this);
        }

        return $this;
    }

    public function removeNotice(Notice $notice): static
    {
        if ($this->notices->removeElement($notice)) {
            // set the owning side to null (unless already changed)
            if ($notice->getGuitarist() === $this) {
                $notice->setGuitarist(null);
            }
        }

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
            $setting->setGuitarist($this);
        }

        return $this;
    }

    public function removeSetting(Setting $setting): static
    {
        if ($this->settings->removeElement($setting)) {
            // set the owning side to null (unless already changed)
            if ($setting->getGuitarist() === $this) {
                $setting->setGuitarist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, material>
     */
    public function getMaterial(): Collection
    {
        return $this->material;
    }

    public function addMaterial(Material $material): static
    {
        if (!$this->material->contains($material)) {
            $this->material->add($material);
        }

        return $this;
    }

    public function removeMaterial(Material $material): static
    {
        $this->material->removeElement($material);

        return $this;
    }
}
