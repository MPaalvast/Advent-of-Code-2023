<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D14')]
class D14Service implements DayServiceInterface
{
    private int $total = 0;
    private int $maxX = 0;
    private int $maxY = 0;
    private int $splitX = 0;
    private int $splitY = 0;
    private array $robots = [];
    private array $locations = [];
    private int $seconds =0;

    public function generatePart1(array $rows): string
    {
        $this->maxX = 101;
        $this->splitX = 50;
        $this->maxY = 103;
        $this->splitY = 51;
        $this->seconds = 100;

        $this->getRobots($rows);
        $this->calculateEndPositions();
        $this->calculateTotal();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        return $this->total;
    }

    private function getRobots(array $rows): void
    {
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $parts = explode(' v=', $row);

            $robotLocation = explode(',', substr($parts[0], 2));
            $robotSpeed = explode(',', $parts[1]);
            $this->robots[] = [
                'location' => [
                    'x' => $robotLocation[0],
                    'y' => $robotLocation[1],
                ],
                'speed' => [
                    'x' => $robotSpeed[0],
                    'y' => $robotSpeed[1],
                ]
            ];
        }
    }

    private function calculateEndPositions(): void
    {
        foreach ($this->robots as $robot) {
            $endLocationX = (($robot['speed']['x'] * $this->seconds) + $robot['location']['x']) % $this->maxX;
            $endLocationY = (($robot['speed']['y'] * $this->seconds) + $robot['location']['y']) % $this->maxY;
            $this->setLocation($endLocationX, $endLocationY);
        }
    }

    private function setLocation(int $endLocationX, int $endLocationY): void
    {
        if ($endLocationX < 0) {
            $endLocationX = $endLocationX + $this->maxX;
        }
        if ($endLocationY < 0) {
            $endLocationY = $endLocationY + $this->maxY;
        }

        if ($endLocationX < $this->splitX && $endLocationY < $this->splitY) {
            $this->locations[1][] = $endLocationX . '-' . $endLocationY;
        } elseif ($endLocationX > $this->splitX && $endLocationY < $this->splitY) {
            $this->locations[2][] = $endLocationX . '-' . $endLocationY;
        } elseif ($endLocationX < $this->splitX && $endLocationY > $this->splitY) {
            $this->locations[3][] = $endLocationX . '-' . $endLocationY;
        } elseif ($endLocationX <> $this->splitX && $endLocationY > $this->splitY) {
            $this->locations[4][] = $endLocationX . '-' . $endLocationY;
        }
    }

    private function calculateTotal(): void
    {
        $this->total = count($this->locations[1]) * count($this->locations[2]) * count($this->locations[3]) * count($this->locations[4]);
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}
