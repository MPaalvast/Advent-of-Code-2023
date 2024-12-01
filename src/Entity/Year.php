<?php

namespace App\Entity;

use App\Repository\YearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: YearRepository::class)]
class Year
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $title = null;

    /**
     * @var Collection<int, GameDay>
     */
    #[ORM\OneToMany(targetEntity: GameDay::class, mappedBy: 'year')]
    private Collection $gameDays;

    public function __construct()
    {
        $this->gameDays = new ArrayCollection();
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

    public function getTitle(): ?int
    {
        return $this->title;
    }

    public function setTitle(int $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, GameDay>
     */
    public function getGameDays(): Collection
    {
        return $this->gameDays;
    }

    public function addGameDay(GameDay $gameDay): static
    {
        if (!$this->gameDays->contains($gameDay)) {
            $this->gameDays->add($gameDay);
            $gameDay->setYear($this);
        }

        return $this;
    }

    public function removeGameDay(GameDay $gameDay): static
    {
        if ($this->gameDays->removeElement($gameDay)) {
            // set the owning side to null (unless already changed)
            if ($gameDay->getYear() === $this) {
                $gameDay->setYear(null);
            }
        }

        return $this;
    }
}
