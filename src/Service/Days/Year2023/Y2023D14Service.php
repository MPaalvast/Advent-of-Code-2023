<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;

class Y2023D14Service implements DayServiceInterface
{
    private string $title = "Parabolic Reflector Dish";

    public function getTitle(): string
    {
        return $this->title;
    }

    public function __construct(public array $grid = [], public int $maxRows = 0, public int $maxCol = 0)
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->createGrid($rows);
        $this->moveRocksUp();

        return $this->calculateResult();
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $this->createGrid($rows);
        $totalCycles = 500;
        $y = 0;
        $testArray[$y] = [];
        $i = 0;
        do {
            $this->moveRocksUp();
            $this->rotate();
            $this->moveRocksUp();
            $this->rotate();
            $this->moveRocksUp();
            $this->rotate();
            $this->moveRocksUp();
            $this->rotate();
            $i++;
            $result = $this->calculateResult();
            if (in_array($result, $testArray[$y], true)) {
                $y++;
            }
            $testArray[$y][] = $result;
        } while ($i<=$totalCycles);

        $loop = true;
        $i = 0;
        $cycles = 1000000000;

        $resultArrayValues = [];
        while ($loop) {
            if (implode(',', $testArray[$i]) === implode(',', $testArray[$i+2])) {
                $resultArrayValues = explode(',', implode(',', $testArray[$i]) . ',' . implode(',', $testArray[$i+1]));
                $loop = false;
            } elseif (implode(',', $testArray[$i]) === implode(',', $testArray[$i+3])) {
                $resultArrayValues = explode(',', implode(',', $testArray[$i]) . ',' . implode(',', $testArray[$i+1]) . ',' . implode(',', $testArray[$i+2]));
                $loop = false;
            } else {
                $cycles -= count($testArray[$i]);
                $i++;
            }
        }

        $position = $cycles%count($resultArrayValues);

        return ($resultArrayValues[$position-1]);
    }

    private function createGrid($rows): void
    {
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $this->grid[] = str_split($row);
        }
        $this->maxRows = count($this->grid);
        $this->maxCol = count($this->grid[0]);
    }

    private function moveRocksUp(): void
    {
        foreach ($this->grid as $gridRowNr => $gridRow) {
            if ($gridRowNr === 0) {
                continue;
            }
            $positionsToCheck = array_keys($gridRow, "O");
            foreach ($positionsToCheck as $fieldNr) {
                $i=-1;
                do {
                    $i++;
                } while (isset($this->grid[$gridRowNr-($i+1)]) && $this->grid[$gridRowNr-($i+1)][$fieldNr] === '.');
                if ($i>0) {
                    $this->grid[$gridRowNr-$i][$fieldNr] = 'O';
                    $this->grid[$gridRowNr][$fieldNr] = '.';
                }
            }
        }
    }

    private function calculateResult(): string
    {
        $result = 0;
        $gridTotalRowValue = count($this->grid);
        foreach ($this->grid as $gridRow) {
            $rowCounts = count(array_keys($gridRow, "O"));
            if ($rowCounts > 0) {
                $result += $rowCounts * $gridTotalRowValue;
            }
            $gridTotalRowValue--;
        }

        return (string)$result;
    }

    private function rotate(): void
    {
        $newGrid = [];

        foreach ($this->grid as $gridRowKey => $gridRow) {
            foreach ($gridRow as $fieldKey => $field) {
                $newGrid[$fieldKey][$gridRowKey] = $field;
            }
        }
        foreach ($newGrid as $key => $row) {
            $newGrid[$key] = array_reverse($row);
        }

        $this->grid = $newGrid;
    }
}
