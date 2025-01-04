<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D4')]
class D4Service implements DayServiceInterface
{
    private array $grid = [];
    private int $maxXIndex = 0;
    private int $maxYIndex = 0;
    private int $total = 0;
    private array $startPoints = [];
    private string $searchString = '';

    public function generatePart1(array $rows): string
    {
        $this->searchString = 'XMAS';
        $this->generateGrid($rows, 'X');
        $this->findStringInArray();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->searchString = 'MAS';
        $this->generateGrid($rows, 'A');
        $this->findXStringInArray();

        return $this->total;
    }

    //
    // helper functions below
    //

    private function generateGrid(array  $rows, string $startValue): void
    {
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $gridRow = str_split($row);

            foreach ($gridRow as $y => $rowYValue) {
                if ($rowYValue === $startValue) {
                    $this->startPoints[] = ['x' => $x, 'y' => $y];
                }
            }
            $this->grid[] = $gridRow;
        }
        $this->maxYIndex = count($this->grid[0]);
        $this->maxXIndex = count($this->grid);
    }

    private function findStringInArray(): void
    {
        $spaceFromSide = strlen($this->searchString) -1;
        foreach ($this->startPoints as $startPoint) {
            $canCheckUp = $startPoint['x'] >= $spaceFromSide;
            $canCheckRight = $startPoint['y'] < ($this->maxYIndex - $spaceFromSide);
            $canCheckDown = $startPoint['x'] < ($this->maxXIndex - $spaceFromSide);
            $canCheckLeft = $startPoint['y'] >= $spaceFromSide;

            if ($canCheckUp) {
                $this->searchUp($startPoint['x'], $startPoint['y']);
                if ($canCheckRight) {
                    $this->searchRightUp($startPoint['x'], $startPoint['y']);
                }
                if ($canCheckLeft) {
                    $this->searchLeftUp($startPoint['x'], $startPoint['y']);
                }
            }
            if ($canCheckDown) {
                $this->searchDown($startPoint['x'], $startPoint['y']);
                if ($canCheckRight) {
                    $this->searchRightDown($startPoint['x'], $startPoint['y']);
                }
                if ($canCheckLeft) {
                    $this->searchLeftDown($startPoint['x'], $startPoint['y']);
                }
            }
            if ($canCheckLeft) {
                $this->searchLeft($startPoint['x'], $startPoint['y']);
            }
            if ($canCheckRight) {
                $this->searchRight($startPoint['x'], $startPoint['y']);
            }
        }
    }

    private function searchLeft($x, $y): void
    {

        if (sprintf('%s%s%s%s', $this->grid[$x][$y], $this->grid[$x][$y-1], $this->grid[$x][$y-2], $this->grid[$x][$y-3]) === $this->searchString) {
            $this->total++;
        }
    }

    private function searchRight($x, $y): void
    {
        if (sprintf('%s%s%s%s', $this->grid[$x][$y], $this->grid[$x][$y+1], $this->grid[$x][$y+2], $this->grid[$x][$y+3]) === $this->searchString) {
            $this->total++;
        }
    }

    private function searchUp($x, $y): void
    {
        if (sprintf('%s%s%s%s', $this->grid[$x][$y], $this->grid[$x-1][$y], $this->grid[$x-2][$y], $this->grid[$x-3][$y]) === $this->searchString) {
            $this->total++;
        }
    }

    private function searchDown($x, $y): void
    {
        if (sprintf('%s%s%s%s', $this->grid[$x][$y], $this->grid[$x+1][$y], $this->grid[$x+2][$y], $this->grid[$x+3][$y]) === $this->searchString) {
            $this->total++;
        }
    }

    private function searchLeftUp($x, $y): void
    {
        if (sprintf('%s%s%s%s', $this->grid[$x][$y], $this->grid[$x-1][$y-1], $this->grid[$x-2][$y-2], $this->grid[$x-3][$y-3]) === $this->searchString) {
            $this->total++;
        }
    }

    private function searchRightUp($x, $y): void
    {
        if (sprintf('%s%s%s%s', $this->grid[$x][$y], $this->grid[$x-1][$y+1], $this->grid[$x-2][$y+2], $this->grid[$x-3][$y+3]) === $this->searchString) {
            $this->total++;
        }
    }

    private function searchLeftDown($x, $y): void
    {
        if (sprintf('%s%s%s%s', $this->grid[$x][$y], $this->grid[$x+1][$y-1], $this->grid[$x+2][$y-2], $this->grid[$x+3][$y-3]) === $this->searchString) {
            $this->total++;
        }
    }

    private function searchRightDown($x, $y): void
    {
        if (sprintf('%s%s%s%s', $this->grid[$x][$y], $this->grid[$x+1][$y+1], $this->grid[$x+2][$y+2], $this->grid[$x+3][$y+3]) === $this->searchString) {
            $this->total++;
        }
    }

    private function findXStringInArray(): void
    {
        $spaceFromSide = floor(strlen($this->searchString)/2);
        foreach ($this->startPoints as $startPoint) {
            $this->searchXPattern($startPoint, $spaceFromSide);
        }
    }

    private function searchXPattern(array$startPoint, int $spaceFromSide): void
    {
        $x = $startPoint['x'];
        $y = $startPoint['y'];
        $canCheckUp = $startPoint['x'] >= $spaceFromSide;
        $canCheckRight = $startPoint['y'] < ($this->maxYIndex - $spaceFromSide);
        $canCheckDown = $startPoint['x'] < ($this->maxXIndex - $spaceFromSide);
        $canCheckLeft = $startPoint['y'] >= $spaceFromSide;

        if ($canCheckUp && $canCheckRight && $canCheckDown && $canCheckLeft) {
            $word1 = sprintf('%s%s%s', $this->grid[$x-1][$y-1], $this->grid[$x][$y], $this->grid[$x+1][$y+1]);
            $word2 = sprintf('%s%s%s', $this->grid[$x+1][$y-1], $this->grid[$x][$y], $this->grid[$x-1][$y+1]);

            if (
                (in_array($this->searchString, [$word1, strrev($word1)], true)) &&
                (in_array($this->searchString, [$word2, strrev($word2)], true))
            ) {
                $this->total++;
            }
        }
    }
}
