<?php

namespace App\Service\Days\Year2025;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2025D4')]
class D4Service implements DayServiceInterface
{

    private array $grid = [];
    private array $movableRolles = [];
    private int $totalMovableRolles = 0;
    private int $maxYIndex = 0;
    private int $maxXIndex = 0;
    public function generatePart1(array $rows): string
    {
        $this->generateGrid($rows);
        $this->findRolles();
        return count($this->movableRolles);
    }

    public function generatePart2(array $rows): string
    {
        $this->generateGrid($rows);
        $this->findAllRolles();
        return $this->totalMovableRolles;
    }

    private function findAllRolles(): void
    {
        while (true) {
            $this->movableRolles = [];

            $this->findRolles();

            // update total moved
            $this->totalMovableRolles += count($this->movableRolles);

            if (empty($this->movableRolles)) {
                break;
            }
            $this->updateGrid();
        }
    }

    private function updateGrid(): void
    {
        foreach ($this->movableRolles as $roll) {
            [$y, $x] = explode('-', $roll);
            $this->grid[$y][$x] = '.';
        }
    }

    private function findRolles(): void
    {
        for ($y=0; $y < $this->maxYIndex; ++$y) {
            for ($x=0; $x < $this->maxXIndex; ++$x) {
                if ($this->grid[$y][$x] === '@' && $this->getNeighbourRolls($x, $y) < 4) {
                    $this->movableRolles[] = $y . '-' . $x;
                }
            }
        }
    }

    private function generateGrid(array  $rows): void
    {
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $this->grid[] = str_split($row);
        }
        $this->maxXIndex = count($this->grid[0]);
        $this->maxYIndex = count($this->grid);
    }

    private function getNeighbourRolls(int $x, int $y): int
    {
        $neighbours = 0;
        if (isset($this->grid[$y-1][$x-1]) && $this->grid[$y-1][$x-1] === '@') {
            $neighbours++;
        }
        if (isset($this->grid[$y-1][$x]) && $this->grid[$y-1][$x] === '@') {
            $neighbours++;
        }
        if (isset($this->grid[$y-1][$x+1]) && $this->grid[$y-1][$x+1] === '@') {
            $neighbours++;
        }
        if (isset($this->grid[$y][$x-1]) && $this->grid[$y][$x-1] === '@') {
            $neighbours++;
        }
        if (isset($this->grid[$y][$x+1]) && $this->grid[$y][$x+1] === '@') {
            $neighbours++;
        }
        if (isset($this->grid[$y+1][$x-1]) && $this->grid[$y+1][$x-1] === '@') {
            $neighbours++;
        }
        if (isset($this->grid[$y+1][$x]) && $this->grid[$y+1][$x] === '@') {
            $neighbours++;
        }
        if (isset($this->grid[$y+1][$x+1]) && $this->grid[$y+1][$x+1] === '@') {
            $neighbours++;
        }

        return $neighbours;
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^[.@]+$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}