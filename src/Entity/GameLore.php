<?php

namespace App\Entity;

use App\Repository\GameLoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameLoreRepository::class)]
class GameLore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gameLores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lore $lore_id = null;

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

    public function getLoreId(): ?Lore
    {
        return $this->lore_id;
    }

    public function setLoreId(?Lore $lore_id): static
    {
        $this->lore_id = $lore_id;

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
