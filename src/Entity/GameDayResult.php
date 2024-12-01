<?php

namespace App\Entity;

use App\Repository\GameDayResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameDayResultRepository::class)]
class GameDayResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gameDayResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GameDay $gameDay = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?DayPart $dayPart = null;

    #[ORM\Column]
    private ?bool $solved = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getGameDay(): ?GameDay
    {
        return $this->gameDay;
    }

    public function setGameDay(?GameDay $gameDay): static
    {
        $this->gameDay = $gameDay;

        return $this;
    }

    public function getDayPart(): ?DayPart
    {
        return $this->dayPart;
    }

    public function setDayPart(?DayPart $dayPart): static
    {
        $this->dayPart = $dayPart;

        return $this;
    }

    public function isSolved(): ?bool
    {
        return $this->solved;
    }

    public function setSolved(bool $solved): static
    {
        $this->solved = $solved;

        return $this;
    }
}
