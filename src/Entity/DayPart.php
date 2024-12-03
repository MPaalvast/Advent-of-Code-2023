<?php

namespace App\Entity;

use App\Repository\DayPartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DayPartRepository::class)]
class DayPart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Title = null;

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
        return $this->Title;
    }

    public function setTitle(int $Title): static
    {
        $this->Title = $Title;

        return $this;
    }
}
