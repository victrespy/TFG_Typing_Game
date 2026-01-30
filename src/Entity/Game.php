<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $game_id = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\OneToOne(mappedBy: 'game_id', cascade: ['persist', 'remove'])]
    private ?Stats $stats = null;

    /**
     * @var Collection<int, Maestry>
     */
    #[ORM\OneToMany(targetEntity: Maestry::class, mappedBy: 'game_id')]
    private Collection $maestries;

    /**
     * @var Collection<int, GameUpgrades>
     */
    #[ORM\OneToMany(targetEntity: GameUpgrades::class, mappedBy: 'game_id')]
    private Collection $gameUpgrades;

    /**
     * @var Collection<int, GameLore>
     */
    #[ORM\OneToMany(targetEntity: GameLore::class, mappedBy: 'game_id')]
    private Collection $gameLores;

    public function __construct()
    {
        $this->maestries = new ArrayCollection();
        $this->gameUpgrades = new ArrayCollection();
        $this->gameLores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameId(): ?int
    {
        return $this->game_id;
    }

    public function setGameId(int $game_id): static
    {
        $this->game_id = $game_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getStats(): ?Stats
    {
        return $this->stats;
    }

    public function setStats(Stats $stats): static
    {
        // set the owning side of the relation if necessary
        if ($stats->getGameId() !== $this) {
            $stats->setGameId($this);
        }

        $this->stats = $stats;

        return $this;
    }

    /**
     * @return Collection<int, Maestry>
     */
    public function getMaestries(): Collection
    {
        return $this->maestries;
    }

    public function addMaestry(Maestry $maestry): static
    {
        if (!$this->maestries->contains($maestry)) {
            $this->maestries->add($maestry);
            $maestry->setGameId($this);
        }

        return $this;
    }

    public function removeMaestry(Maestry $maestry): static
    {
        if ($this->maestries->removeElement($maestry)) {
            // set the owning side to null (unless already changed)
            if ($maestry->getGameId() === $this) {
                $maestry->setGameId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GameUpgrades>
     */
    public function getGameUpgrades(): Collection
    {
        return $this->gameUpgrades;
    }

    public function addGameUpgrade(GameUpgrades $gameUpgrade): static
    {
        if (!$this->gameUpgrades->contains($gameUpgrade)) {
            $this->gameUpgrades->add($gameUpgrade);
            $gameUpgrade->setGameId($this);
        }

        return $this;
    }

    public function removeGameUpgrade(GameUpgrades $gameUpgrade): static
    {
        if ($this->gameUpgrades->removeElement($gameUpgrade)) {
            // set the owning side to null (unless already changed)
            if ($gameUpgrade->getGameId() === $this) {
                $gameUpgrade->setGameId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GameLore>
     */
    public function getGameLores(): Collection
    {
        return $this->gameLores;
    }

    public function addGameLore(GameLore $gameLore): static
    {
        if (!$this->gameLores->contains($gameLore)) {
            $this->gameLores->add($gameLore);
            $gameLore->setGameId($this);
        }

        return $this;
    }

    public function removeGameLore(GameLore $gameLore): static
    {
        if ($this->gameLores->removeElement($gameLore)) {
            // set the owning side to null (unless already changed)
            if ($gameLore->getGameId() === $this) {
                $gameLore->setGameId(null);
            }
        }

        return $this;
    }
}
