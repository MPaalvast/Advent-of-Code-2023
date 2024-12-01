<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;

class Y2024D1Service implements DayServiceInterface
{
    private string $title = "Historian Hysteria";

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        // explode row on 3 spaces (any spaces with regex) and make 2 arrays
        // order both arrays asc and loop over them to calculate the diff
        // keep a total of the diff (array_sum())
        $leftArray = [];
        $rightArray = [];

        foreach ($rows as $row) {
            [$left, $right] = explode("   ", $row);
            $leftArray[] = $left;
            $rightArray[] = $right;
        }

        $totalDiff = $this->getDiff($leftArray, $rightArray);

        return $totalDiff;
    }

    private function getDiff($leftValueArray, $rightValueArray): int
    {
        $totalDiff = 0;
        sort($leftValueArray);
        sort($rightValueArray);
        foreach ($leftValueArray as $key => $leftValue) {
            $totalDiff += abs($leftValue - $rightValueArray[$key]);
        }

        return $totalDiff;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return 0;
    }
}