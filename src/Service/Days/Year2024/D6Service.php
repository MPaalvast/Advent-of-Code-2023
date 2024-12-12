<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D6')]
class D6Service implements DayServiceInterface
{
    private string $title = "Guard Gallivant";

    private array $grid = [];

    private array $currentPoint = [];

    private array $visitedFieldsData = [];

    private string $currentDirection = '';

    private array $loopingFields = [];

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
        $this->generateGrid($rows);
        $this->move(true);
        $this->calculateLoopOptions();

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
                    $this->currentDirection = match ($rowYValue) {
                        '^' => 'up',
                        '<' => 'left',
                        '>' => 'right',
                        'v' => 'down',
                    };
                    $this->visitedFieldsData[$x . '-' . $y][$this->currentDirection] = $this->currentDirection;
                }
            }
            $this->grid[] = $gridRow;
        }
    }

    private function move(bool $findLoops = false): void
    {
        $currentX = $this->currentPoint['x'];
        $currentY = $this->currentPoint['y'];
        while (true) {
            [$nextX, $nextY] = $this->getNextCoordinates($currentX, $currentY, $this->currentDirection);
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

            if (
                $findLoops &&
                !isset($this->visitedFieldsData[$nextIndex]) &&
                !in_array($nextIndex, $this->loopingFields, true) &&
                $this->findLoop($nextX, $nextY))
            {
                $this->loopingFields[] = $nextIndex;
            }

            if (!isset($this->visitedFieldsData[$nextIndex])) {
                $this->visitedFieldsData[$nextIndex][$this->currentDirection] = $this->currentDirection;
            } elseif (!isset($this->visitedFieldsData[$nextIndex][$this->currentDirection])) {
                $this->visitedFieldsData[$nextIndex][$this->currentDirection] = $this->currentDirection;
            }
            $this->currentPoint = ['x' => $nextX, 'y' => $nextY];
            $currentX = $nextX;
            $currentY = $nextY;
        }
    }

    private function findLoop(int $blockedX, int $blockedY): bool
    {
         $direction = $this->currentDirection;
         $currentX = $this->currentPoint['x'];
         $currentY = $this->currentPoint['y'];
         $visitedFields = $this->visitedFieldsData;
         while (true) {
             $grid = $this->grid;
             [$nextX, $nextY] = $this->getNextCoordinates($currentX, $currentY, $direction);
             if (!isset($grid[$nextX][$nextY])) {
                 // moved of the grid
                 return false;
             }

             if (
                 $grid[$nextX][$nextY] === '#'
                 || ($nextX === $blockedX && $nextY === $blockedY)
             ) {
                 // turn to the next direction
                 $direction = $this->nextDirection[$direction];
                 continue;
             }

             $nextIndex = $nextX . '-' . $nextY;
             if (isset($visitedFields[$nextIndex][$direction])) {
                 return true;
             }

             if (!isset($visitedFields[$nextIndex])) {
                 $visitedFields[$nextIndex][$direction] = $direction;
             } else {
                 $visitedFields[$nextIndex][$direction] = $direction;
             }

             $currentX = $nextX;
             $currentY = $nextY;
         }
    }

    private function getNextCoordinates(int $x, int $y, string $direction): array
    {
        match ($direction) {
            'up' => --$x,
            'down' => ++$x,
            'left' => --$y,
            'right' => ++$y,
        };

        return [$x, $y];
    }

    private function calculateVisitedFields(): void
    {
        $this->total = count($this->visitedFieldsData);
    }
    private function calculateLoopOptions(): void
    {
        $this->total = count($this->loopingFields);
    }
}
