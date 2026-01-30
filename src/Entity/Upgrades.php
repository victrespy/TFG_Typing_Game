<?php

namespace App\Entity;

use App\Repository\UpgradesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UpgradesRepository::class)]
class Upgrades
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $upgrade_id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $unlock_condition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUpgradeId(): ?int
    {
        return $this->upgrade_id;
    }

    public function setUpgradeId(int $upgrade_id): static
    {
        $this->upgrade_id = $upgrade_id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    public function getUnlockCondition(): ?string
    {
        return $this->unlock_condition;
    }

    public function setUnlockCondition(string $unlock_condition): static
    {
        $this->unlock_condition = $unlock_condition;

        return $this;
    }
}
