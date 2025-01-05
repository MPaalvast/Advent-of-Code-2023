<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D3')]
class D3Service implements DayServiceInterface
{
    private int $total = 0;
    private array $visited = ['0-0'];
    private array $input = [];
    private array $santaCurrentLocation = ['x' => 0, 'y' => 0];
    private array $helperCurrentLocation = ['x' => 0, 'y' => 0];

    public function generatePart1(array $rows): string
    {
        $this->initInput($rows);
        $this->findSantaHouses();
        $this->calculateVisitedHouses();
        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->initInput($rows);
        $this->findSantaAndHelperHouses();
        $this->calculateVisitedHouses();
        return $this->total;
    }

    private function initInput(array $rows): void
    {
        $this->input = str_split($rows[0]);
    }

    private function findSantaHouses(): void
    {
        foreach ($this->input as $direction) {
            $this->walkSanta($direction);
        }
    }

    private function findSantaAndHelperHouses(): void
    {
        foreach ($this->input as $key => $direction) {
            if ($key % 2 === 0) {
                $this->walkSanta($direction);
                continue;
            }
            $this->walkHelper($direction);
        }
    }

    private function walkSanta(string $direction): void
    {
        $this->walk($this->santaCurrentLocation, $direction);
        $this->checkLocation(...$this->santaCurrentLocation);
    }

    private function walkHelper(string $direction): void
    {
        $this->walk($this->helperCurrentLocation, $direction);
        $this->checkLocation(...$this->helperCurrentLocation);
    }

    private function walk(array &$currentLocation, string $direction): void
    {
        match ($direction) {
            '^' => --$currentLocation['x'],
            '>' => ++$currentLocation['y'],
            'v' => ++$currentLocation['x'],
            '<' => --$currentLocation['y'],
        };
    }

    private function checkLocation(int $x, int $y): void
    {
        if (!in_array($x . '-' . $y, $this->visited, true)) {
            $this->visited[] = $x . '-' . $y;
        }
    }

    private function calculateVisitedHouses(): void
    {
        $this->total = count($this->visited);
    }

    /**
     * $rows[0] can only contain < or ^ or > or v
     *
     * @param array<string> $rows
     */
    public function isValidInput(array $rows): bool
    {
        preg_match('/^[>v<^]+$/', $rows[0], $matches);
        if (empty($matches)) {
            return false;
        }
        return true;
    }
}