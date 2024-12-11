<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D11')]
class D11Service implements DayServiceInterface
{
    private string $title = "Cosmic Expansion";

    public function getTitle(): string
    {
        return $this->title;
    }

    public function __construct(public array $normalizedGrid = [], public array $grid = [], public array $planetLocations = [], public array $emptyData = [])
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->generateGrid($rows);

        return (string)$this->generateDistance(1);
    }
    public function generatePart2(array|\Generator $rows): string
    {
        $this->generateGrid($rows);

        return (string)$this->generateDistance(999999);
    }

    private function generateGrid($rows): void
    {
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $gridRow = str_split($row);
            $rowValues = array_count_values($gridRow);
            if (count($rowValues) === 1) {
                $this->emptyData['row'][$x] = $x;
            }
            foreach ($gridRow as $y => $rowYValue) {
                if ($rowYValue === '#') {
                    $this->planetLocations[] = ['x' => $x, 'y' => $y];
                }
            }
            $this->grid[] = $gridRow;
        }
        $maxY = count($this->grid[0]);
        for ($y = 0; $y < $maxY; $y++) {
            $columnArray = [];
            foreach ($this->grid as $x => $xValue) {
                $columnArray[] = $this->grid[$x][$y];
            }

            $columnValues = array_count_values($columnArray);
            if (count($columnValues) === 1) {
                $this->emptyData['column'][$y] = $y;
            }
        }
    }

    private function generateDistance(int $emptyMultiplier): int
    {
        $distance = 0;
        $planetLocations = $this->planetLocations;
        while(!empty($planetLocations)) {
            $currentPlanetLocation = array_shift($planetLocations);
            foreach ($planetLocations as $planetLocation) {
                $distanceRowRange = range(min($planetLocation['x'], $currentPlanetLocation['x']), max($planetLocation['x'], $currentPlanetLocation['x']));
                $addedRows = 0;
                foreach ($distanceRowRange as $row) {
                    if (isset($this->emptyData['row'][$row])) {
                        $addedRows += $emptyMultiplier;
                    }
                }
                $distanceColumnRange = range(min($planetLocation['y'], $currentPlanetLocation['y']), max($planetLocation['y'], $currentPlanetLocation['y']));
                $addedColumns = 0;
                foreach ($distanceColumnRange as $column) {
                    if (isset($this->emptyData['column'][$column])) {
                        $addedColumns += $emptyMultiplier;
                    }
                }
                $distance += max($planetLocation['x'], $currentPlanetLocation['x']) - min($planetLocation['x'], $currentPlanetLocation['x']);
                $distance += $addedRows;
                $distance += max($planetLocation['y'], $currentPlanetLocation['y']) - min($planetLocation['y'], $currentPlanetLocation['y']);
                $distance += $addedColumns;
            }
        }

        return $distance;
    }
}
