<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 150)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $avatar = null;

    #[ORM\Column(length: 100)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Accueil::class)]
    private Collection $accueils;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Article::class)]
    private Collection $articles;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Regulation::class)]
    private Collection $regulations;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Submission::class)]
    private Collection $submissions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Messaging::class)]
    private Collection $messagings;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Guitarist::class)]
    private Collection $guitarists;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Notice::class)]
    private Collection $notices;

    public function __construct()
    {
        $this->accueils = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->regulations = new ArrayCollection();
        $this->submissions = new ArrayCollection();
        $this->messagings = new ArrayCollection();
        $this->guitarists = new ArrayCollection();
        $this->notices = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        if ($this->created_at === null) {
            $this->created_at = new \DateTimeImmutable();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Accueil>
     */
    public function getAccueils(): Collection
    {
        return $this->accueils;
    }

    public function addAccueil(Accueil $accueil): static
    {
        if (!$this->accueils->contains($accueil)) {
            $this->accueils->add($accueil);
            $accueil->setUser($this);
        }

        return $this;
    }

    public function removeAccueil(Accueil $accueil): static
    {
        if ($this->accueils->removeElement($accueil)) {
            // set the owning side to null (unless already changed)
            if ($accueil->getUser() === $this) {
                $accueil->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setUser($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getUser() === $this) {
                $article->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Regulation>
     */
    public function getRegulations(): Collection
    {
        return $this->regulations;
    }

    public function addRegulation(Regulation $regulation): static
    {
        if (!$this->regulations->contains($regulation)) {
            $this->regulations->add($regulation);
            $regulation->setUser($this);
        }

        return $this;
    }

    public function removeRegulation(Regulation $regulation): static
    {
        if ($this->regulations->removeElement($regulation)) {
            // set the owning side to null (unless already changed)
            if ($regulation->getUser() === $this) {
                $regulation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Submission>
     */
    public function getSubmissions(): Collection
    {
        return $this->submissions;
    }

    public function addSubmission(Submission $submission): static
    {
        if (!$this->submissions->contains($submission)) {
            $this->submissions->add($submission);
            $submission->setUser($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): static
    {
        if ($this->submissions->removeElement($submission)) {
            // set the owning side to null (unless already changed)
            if ($submission->getUser() === $this) {
                $submission->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messaging>
     */
    public function getMessagings(): Collection
    {
        return $this->messagings;
    }

    public function addMessaging(Messaging $messaging): static
    {
        if (!$this->messagings->contains($messaging)) {
            $this->messagings->add($messaging);
            $messaging->setUser($this);
        }

        return $this;
    }

    public function removeMessaging(Messaging $messaging): static
    {
        if ($this->messagings->removeElement($messaging)) {
            // set the owning side to null (unless already changed)
            if ($messaging->getUser() === $this) {
                $messaging->setUser(null);
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
            $guitarist->setUser($this);
        }

        return $this;
    }

    public function removeGuitarist(Guitarist $guitarist): static
    {
        if ($this->guitarists->removeElement($guitarist)) {
            // set the owning side to null (unless already changed)
            if ($guitarist->getUser() === $this) {
                $guitarist->setUser(null);
            }
        }

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
            $notice->setUser($this);
        }

        return $this;
    }

    public function removeNotice(Notice $notice): static
    {
        if ($this->notices->removeElement($notice)) {
            // set the owning side to null (unless already changed)
            if ($notice->getUser() === $this) {
                $notice->setUser(null);
            }
        }

        return $this;
    }
}
