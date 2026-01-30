<?php

namespace App\Entity;

use App\Repository\LoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoreRepository::class)]
class Lore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $lore_id = null;

    #[ORM\Column(length: 255)]
    private ?string $descrption = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoreId(): ?int
    {
        return $this->lore_id;
    }

    public function setLoreId(int $lore_id): static
    {
        $this->lore_id = $lore_id;

        return $this;
    }

    public function getDescrption(): ?string
    {
        return $this->descrption;
    }

    public function setDescrption(string $descrption): static
    {
        $this->descrption = $descrption;

        return $this;
    }
}
