<?php

namespace App\Service\Days\Year2025;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2025D7')]
class D7Service implements DayServiceInterface
{
    private array $grid = [];
    private int $maxYIndex = 0;
    private array $startPoint = [];
    private int $totalSplitters = 0;
    private int $totalTimelines = 0;
    public function generatePart1(array $rows): string
    {
        $this->generateGrid($rows, 'S');
        $this->startBeam();
        return $this->totalSplitters;
    }

    public function generatePart2(array $rows): string
    {
        $this->generateGrid($rows, 'S');
        $this->startBeam();
        return $this->totalTimelines;
    }

    private function startBeam(): void
    {
        $key = $this->startPoint['y'] . '-' . $this->startPoint['x'];
        $beamLocations= [$key => [
            'x' => $this->startPoint['x'],
            'y' => $this->startPoint['y'],
            'timelines' => 1,
        ]];
        while (!empty($beamLocations)) {
            $beam  = array_shift($beamLocations);
            if ($beam['y']+1 >= $this->maxYIndex) {
                // totalTimelines
                $this->totalTimelines += $beam['timelines'];
                continue;
            }
            // dubbele code eruit halen
            if ($this->grid[$beam['y']+1][$beam['x']] !== '^') {
                $newKey = $beam['y']+1 . '-' . $beam['x'];
                if (!isset($beamLocations[$newKey])) {
                    $beamLocations[$newKey] = ['y' => $beam['y']+1, 'x' => $beam['x'], 'timelines' => $beam['timelines']];
                } else {
                    $beamLocations[$newKey]['timelines'] += $beam['timelines'];
                }
                continue;
            }
            if ($this->grid[$beam['y']+1][$beam['x']] === '^') {
                $this->totalSplitters++;
                $newKeyL = $beam['y']+1 . '-' . $beam['x']-1;
                if (!isset($beamLocations[$newKeyL])) {
                    $beamLocations[$newKeyL] = ['y' => $beam['y']+1, 'x' => $beam['x']-1, 'timelines' => $beam['timelines']];
                } else {
                    $beamLocations[$newKeyL]['timelines'] += $beam['timelines'];
                }
                $newKeyR = $beam['y']+1 . '-' . $beam['x']+1;
                if (!isset($beamLocations[$newKeyR])) {
                    $beamLocations[$newKeyR] = ['y' => $beam['y']+1, 'x' => $beam['x']+1, 'timelines' => $beam['timelines']];
                } else {
                    $beamLocations[$newKeyR]['timelines'] += $beam['timelines'];
                }
            }
        }
    }

    private function generateGrid(array  $rows, string $startValue): void
    {
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $gridRow = str_split($row);

            if (empty($this->startPoint)) {
                foreach ($gridRow as $y => $rowYValue) {
                    if ($rowYValue === $startValue) {
                        $this->startPoint = ['y' => $x, 'x' => $y];
                        break;
                    }
                }
            }

            $this->grid[] = $gridRow;
        }
        $this->maxYIndex = count($this->grid);
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^[.+|S|^]+$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}