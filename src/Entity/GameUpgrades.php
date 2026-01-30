<?php

namespace App\Entity;

use App\Repository\GameUpgradesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameUpgradesRepository::class)]
class GameUpgrades
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gameUpgrades')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Upgrades $upgrade_id = null;

    #[ORM\Column]
    private ?bool $unlocked = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameId(): ?Game
    {
        return $this->game_id;
    }

    public function setGameId(?Game $game_id): static
    {
        $this->game_id = $game_id;

        return $this;
    }

    public function getUpgradeId(): ?Upgrades
    {
        return $this->upgrade_id;
    }

    public function setUpgradeId(?Upgrades $upgrade_id): static
    {
        $this->upgrade_id = $upgrade_id;

        return $this;
    }

    public function isUnlocked(): ?bool
    {
        return $this->unlocked;
    }

    public function setUnlocked(bool $unlocked): static
    {
        $this->unlocked = $unlocked;

        return $this;
    }
}
