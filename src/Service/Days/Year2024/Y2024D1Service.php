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
        return $this->calculateDiff($rows);
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return $this->calculateSum($rows);
    }

    //
    // helper functions below
    //

    private function calculateDiff(array|\Generator $rows): int
    {
        $arrayData = $this->createLeftAndRightArray($rows);

        return $this->getDiff($arrayData);
    }

    private function createLeftAndRightArray(array|\Generator $rows): array
    {
        $arrayData = ['left' => [], 'right' => []];

        foreach ($rows as $row) {
            [$left, $right] = explode("   ", $row);
            $arrayData['left'][] = $left;
            $arrayData['right'][] = $right;
        }
        return $arrayData;
    }

    private function getDiff(array $arrayData): int
    {
        $totalDiff = 0;
        sort($arrayData['left']);
        sort($arrayData['right']);
        foreach ($arrayData['left'] as $key => $leftValue) {
            $totalDiff += abs($leftValue - $arrayData['right'][$key]);
        }

        return $totalDiff;
    }

    private function calculateSum(array|\Generator $rows): int
    {
        $arrayData = $this->createLeftAndRightArray($rows);

        return $this->getSum($arrayData);
    }

    private function getSum(array $arrayData): int
    {
        $totalSum = 0;
        foreach ($arrayData['left'] as $leftValue) {
            $totalSum += count(array_keys($arrayData['right'], $leftValue)) * $leftValue;
        }

        return $totalSum;
    }
}