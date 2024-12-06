<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D6')]
class Y2024D6Service implements DayServiceInterface
{
    private string $title = "Guard Gallivant";

    private int $maxXIndex = 0;

    private int $maxYIndex = 0;

    private array $grid = [];

    private array $currentPoint = [];

    private array $visitedFields = [];

    private string $currentDirection = '';

    private array $blockingFields = [];

    private array $nextDirection = [
        'up' => 'right',
        'right' => 'down',
        'down' => 'left',
        'left' => 'up',
    ];
    private int $total = 0;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->generateGrid($rows);
        $this->move();
        $this->calculateVisitedFields();

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return $this->total;
    }

    //
    // helper functions below
    //

    private function generateGrid(array|\Generator  $rows): void
    {
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $gridRow = str_split($row);

            foreach ($gridRow as $y => $rowYValue) {
                if (in_array($rowYValue, ['^', '<', '>', 'v'])) {
                    $this->currentPoint = ['x' => $x, 'y' => $y];
                    $this->visitedFields[$x . '-' . $y] = ['x' => $x, 'y' => $y];
                    $this->currentDirection = match ($rowYValue) {
                        '^' => 'up',
                        '<' => 'left',
                        '>' => 'right',
                        'v' => 'down',
                    };
                }
                if ($rowYValue === '#') {
                    $this->blockingFields[$x . '-' . $y] = ['x' => $x, 'y' => $y];
                }
            }
            $this->grid[] = $gridRow;
        }
        $this->maxYIndex = count($this->grid[0]);
        $this->maxXIndex = count($this->grid);
    }

    private function move(): void
    {
        $currentX = $this->currentPoint['x'];
        $currentY = $this->currentPoint['y'];
        while (true) {
            [$nextX, $nextY] = $this->getNextCoordinates($currentX, $currentY);
            if (!isset($this->grid[$nextX][$nextY])) {
                // moved of the grid
                break;
            }

            if ($this->grid[$nextX][$nextY] === '#') {
                // turn to the next direction
                $this->currentDirection = $this->nextDirection[$this->currentDirection];
                continue;
            }

            $nextIndex = $nextX . '-' . $nextY;
            if (!isset($this->visitedFields[$nextIndex])) {
                // add to the visited fields en move currentPoint to the new location
                $this->visitedFields[$nextIndex] = ['x' => $nextX, 'y' => $nextY];
                $this->currentPoint = ['x' => $nextX, 'y' => $nextY];
            }
            $currentX = $nextX;
            $currentY = $nextY;
        }
    }

    private function getNextCoordinates(int $x, int $y): array
    {
        match ($this->currentDirection) {
            'up' => --$x,
            'down' => ++$x,
            'left' => --$y,
            'right' => ++$y,
        };

        return [$x, $y];
    }

    private function calculateVisitedFields(): void
    {
        $this->total = count($this->visitedFields);
    }
}
