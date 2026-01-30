<?php

namespace App\Entity;

use App\Repository\MaestryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaestryRepository::class)]
class Maestry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'maestries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type_id = null;

    #[ORM\Column]
    private ?int $level = null;

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

    public function getTypeId(): ?Type
    {
        return $this->type_id;
    }

    public function setTypeId(?Type $type_id): static
    {
        $this->type_id = $type_id;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }
}
