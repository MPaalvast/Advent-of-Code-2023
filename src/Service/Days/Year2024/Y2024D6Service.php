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

    private array $visitedFieldsData = [];

    private array $walkedFields = [];

    private string $currentDirection = '';

    private array $blockingFields = [];
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
        // same as part 1
        // but remember the direction of the fields
            // maybe it can have 2 directions???
        // when the next field is not #
            // check the right path for the current position until you see a # or a field with the same direction as you check
                // the next field in the current direction is an obstruction

        $this->generateGrid($rows);
        $this->move(true);
//        $this->findLoops();
        $this->calculateLoopOptions();

//        dump($this->visitedFields);

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
                if ($rowYValue === '#') {
                    $this->blockingFields[$x . '-' . $y] = ['x' => $x, 'y' => $y];
                }
            }
            $this->grid[] = $gridRow;
        }
        $this->maxYIndex = count($this->grid[0]);
        $this->maxXIndex = count($this->grid);
    }

    private function move(bool $findLoops = false): void
    {
        $currentX = $this->currentPoint['x'];
        $currentY = $this->currentPoint['y'];
        $this->walkedFields[] = $currentX . '-' . $currentY;
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

//            if (
//                $findLoops &&
//                !in_array($nextIndex, $walkedFields, true) &&
////                !isset($this->visitedFields[$nextIndex]) &&
////                !in_array($nextIndex, $this->loopingFields, true) &&
//                $this->findLoop($walkedFields))
//            {
//                $this->loopingFields[] = $nextIndex;
//            }

            if (!in_array($nextIndex, $this->walkedFields, true)) {
                $this->walkedFields[] = $nextIndex;
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

//    private function findLoops(): void
//    {
//        // get first field
//        // while $visitedFields is not empty
//        // array shift the next field from direction
//        // added to the new visited fields
//
//        // walk the next direction
//        // if
//        // you find a value in $visitedFields and the direction is the same
//        // loop found
//
//        // but
//        // if the blocking field is in the new visited fields
//        // then it can not be used because you block the original path to the loop.
//        // else
//        // add the loop
//
////        foreach ($this->visitedFields as $fieldDirections) {
////            // walk the next direction
////            // if
////                // you find a value in $this->visitedFields and the direction is the same
////                // loop found
////        }
//
//        $visitedFields = $this->visitedFields;
//        $currentX = $this->currentPoint['x'];
//        $currentY = $this->currentPoint['y'];
//        $currentDirection = $this->currentDirection;
//
//        $walkedList = [];
//
//        while (!empty($visitedFields)) {
//            $index = $currentX . '-' . $currentY;
//            $walkedList[] = $index;
//            if (count($visitedFields[$index]) > 1) {
//                unset($visitedFields[$index][$currentDirection]);
//            }
//        }
//    }

//    private function findLoop(array $walkedFields): bool
//    {
//         $direction = $this->currentDirection;
//         $currentX = $this->currentPoint['x'];
//         $currentY = $this->currentPoint['y'];
//         $directionToCheck = $this->nextDirection[$direction];
//         $visitedFields = $this->visitedFieldsData;
////         $i = 0;
//         while (true) {
//             [$nextX, $nextY] = $this->getNextCoordinates($currentX, $currentY, $directionToCheck);
////             dump($nextX, $nextY, $directionToCheck);
//             if (!isset($this->grid[$nextX][$nextY])) {
//                 return false;
//             }
//
//             // TODO: This has to be turned on when fixed -> fix multiple directions
//             if ($this->grid[$nextX][$nextY] === '#') {
//                 // turn to the next direction
//                 $directionToCheck = $this->nextDirection[$directionToCheck];
//                 continue;
//             }
//
//             $nextIndex = $nextX . '-' . $nextY;
//             if (
//                 isset($visitedFields[$nextIndex][$directionToCheck])
////                 && !in_array($nextIndex, $walkedFields, true)
//             ) {
//                 return true;
//             }
//
//             //
//                 // navigate through and collect visited fields
//                 if (!isset($visitedFields[$nextIndex])) {
//                     // add to the visited fields en move currentPoint to the new location
//                     $visitedFields[$nextIndex][$directionToCheck] = $directionToCheck;
//                     // i think this has to be an array with multiple directions
//                 } else {
//                     $visitedFields[$nextIndex][$directionToCheck] = $directionToCheck;
//                 }
//             //
//
////             $walkedFields[] = $nextIndex;
//             $currentX = $nextX;
//             $currentY = $nextY;
////             $i++;
//         }
////         dump($walkedFields);
//         return false;
//    }

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

    // Part2: result 578 to low
    // Part2: result 2440 to high
    // Part2: result 2350 to high
    // Part2: result 2087 not correct
}
