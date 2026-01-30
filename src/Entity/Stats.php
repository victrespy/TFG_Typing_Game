<?php

namespace App\Entity;

use App\Repository\StatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatsRepository::class)]
class Stats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'stats', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $wpm_best = null;

    #[ORM\Column(nullable: true)]
    private ?float $wpm_avg = null;

    #[ORM\Column(nullable: true)]
    private ?int $wpm_last = null;

    #[ORM\Column(nullable: true)]
    private ?int $er_best = null;

    #[ORM\Column(nullable: true)]
    private ?float $er_avg = null;

    #[ORM\Column(nullable: true)]
    private ?int $er_last = null;

    #[ORM\Column]
    private ?int $total_runs = null;

    #[ORM\Column]
    private ?int $max_level_reached = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameId(): ?Game
    {
        return $this->game_id;
    }

    public function setGameId(Game $game_id): static
    {
        $this->game_id = $game_id;

        return $this;
    }

    public function getWpmBest(): ?int
    {
        return $this->wpm_best;
    }

    public function setWpmBest(?int $wpm_best): static
    {
        $this->wpm_best = $wpm_best;

        return $this;
    }

    public function getWpmAvg(): ?float
    {
        return $this->wpm_avg;
    }

    public function setWpmAvg(?float $wpm_avg): static
    {
        $this->wpm_avg = $wpm_avg;

        return $this;
    }

    public function getWpmLast(): ?int
    {
        return $this->wpm_last;
    }

    public function setWpmLast(?int $wpm_last): static
    {
        $this->wpm_last = $wpm_last;

        return $this;
    }

    public function getErBest(): ?int
    {
        return $this->er_best;
    }

    public function setErBest(?int $er_best): static
    {
        $this->er_best = $er_best;

        return $this;
    }

    public function getErAvg(): ?float
    {
        return $this->er_avg;
    }

    public function setErAvg(?float $er_avg): static
    {
        $this->er_avg = $er_avg;

        return $this;
    }

    public function getErLast(): ?int
    {
        return $this->er_last;
    }

    public function setErLast(?int $er_last): static
    {
        $this->er_last = $er_last;

        return $this;
    }

    public function getTotalRuns(): ?int
    {
        return $this->total_runs;
    }

    public function setTotalRuns(int $total_runs): static
    {
        $this->total_runs = $total_runs;

        return $this;
    }

    public function getMaxLevelReached(): ?int
    {
        return $this->max_level_reached;
    }

    public function setMaxLevelReached(int $max_level_reached): static
    {
        $this->max_level_reached = $max_level_reached;

        return $this;
    }
}
