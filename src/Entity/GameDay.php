<?php

namespace App\Entity;

use App\Model\StatusEnum;
use App\Repository\GameDayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameDayRepository::class)]
class GameDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gameDays')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Year $year = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Day $day = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(enumType: StatusEnum::class)]
    private ?StatusEnum $status = StatusEnum::INACTIVE;

    /**
     * @var Collection<int, GameDayResult>
     */
    #[ORM\OneToMany(targetEntity: GameDayResult::class, mappedBy: 'gameDay')]
    private Collection $gameDayResults;

    /**
     * @var Collection<int, GameDayInput>
     */
    #[ORM\OneToMany(targetEntity: GameDayInput::class, mappedBy: 'gameDay', orphanRemoval: true)]
    private Collection $gameDayInputs;

    public function __construct()
    {
        $this->gameDayResults = new ArrayCollection();
        $this->gameDayInputs = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getYear(): ?Year
    {
        return $this->year;
    }

    public function setYear(?Year $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getDay(): ?Day
    {
        return $this->day;
    }

    public function setDay(Day $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status->value;
    }

    public function setStatus(StatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, GameDayResult>
     */
    public function getGameDayResults(): Collection
    {
        return $this->gameDayResults;
    }

    public function addGameDayResult(GameDayResult $gameDayResult): static
    {
        if (!$this->gameDayResults->contains($gameDayResult)) {
            $this->gameDayResults->add($gameDayResult);
            $gameDayResult->setGameDay($this);
        }

        return $this;
    }

    public function removeGameDayResult(GameDayResult $gameDayResult): static
    {
        if ($this->gameDayResults->removeElement($gameDayResult)) {
            // set the owning side to null (unless already changed)
            if ($gameDayResult->getGameDay() === $this) {
                $gameDayResult->setGameDay(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GameDayInput>
     */
    public function getGameDayInputs(): Collection
    {
        return $this->gameDayInputs;
    }

    public function addGameDayInput(GameDayInput $gameDayInput): static
    {
        if (!$this->gameDayInputs->contains($gameDayInput)) {
            $this->gameDayInputs->add($gameDayInput);
            $gameDayInput->setGameDay($this);
        }

        return $this;
    }

    public function removeGameDayInput(GameDayInput $gameDayInput): static
    {
        if ($this->gameDayInputs->removeElement($gameDayInput)) {
            // set the owning side to null (unless already changed)
            if ($gameDayInput->getGameDay() === $this) {
                $gameDayInput->setGameDay(null);
            }
        }

        return $this;
    }
}
