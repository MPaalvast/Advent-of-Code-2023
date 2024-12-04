<?php

namespace App\Entity;

use App\Repository\GameDayInputRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameDayInputRepository::class)]
class GameDayInput
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?DayPart $dayPart = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $input = null;

    #[ORM\ManyToOne(inversedBy: 'gameDayInputs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GameDay $gameDay = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

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

    public function getInput(): ?string
    {
        return $this->input;
    }

    public function setInput(string $input): static
    {
        $this->input = $input;

        return $this;
    }

    public function getGameDay(): ?GameDay
    {
        return $this->gameDay;
    }

    public function setGameDay(GameDay $gameDay): static
    {
        $this->gameDay = $gameDay;

        return $this;
    }
}
