<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D2')]
class Y2024D2Service implements DayServiceInterface
{
    private string $title = "Red-Nosed Reports";

    private int $part1MinDiff = 1;
    private int $part1MaxDiff = 3;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        return $this->calculateSafeLevels($rows);
    }

    public function generatePart2(array|\Generator $rows): string
    {
        // same as part 1
        // but for every row make different arrays where everytime a number is left out
        // if is passes go to next if it fails change array
        return $this->calculateSafeDampenerLevels($rows);
    }

    //
    // helper functions below
    //

    private function calculateSafeLevels(array|\Generator $rows): string
    {
        $safeLevels = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $rowLevelArray = explode(" ", $row);

            if ($this->checkIfSafe($rowLevelArray)) {
                $safeLevels++;
            }
        }

        return (string)$safeLevels;
    }

    private function checkIfSafe(array $rowLevelArray): bool
    {
        if (current(array_diff_key($rowLevelArray,array_unique($rowLevelArray)))) {
            return false;
        }
        $sortArray = array_values($rowLevelArray);
        sort($sortArray);
        $asortArray = array_values($rowLevelArray);
        rsort($asortArray);

        if (
            $sortArray !== array_values($rowLevelArray) &&
            $asortArray !== array_values($rowLevelArray)
        ) {
            return false;
        }

        return $this->checkIsInDiffSpec($asortArray);
    }

    private function checkIsInDiffSpec(array $rowLevelArray): bool
    {
        $locationA = array_shift($rowLevelArray);
        foreach ($rowLevelArray as $locationB) {
            $diff = abs($locationA - $locationB);
            if (
                $diff < $this->part1MinDiff ||
                $diff > $this->part1MaxDiff
            ) {
                return false;
            }
            $locationA = $locationB;
        }

        return true;
    }

    private function calculateSafeDampenerLevels(array|\Generator $rows): string
    {
        $safeLevels = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $rowLevelArray = explode(" ", $row);

            if ($this->checkIfSafe($rowLevelArray)) {
                $safeLevels++;
                continue;
            }

            for ($i = 0, $iMax = count($rowLevelArray); $i < $iMax; $i++) {
                $valueArray = $rowLevelArray;
                unset($valueArray[$i]);
                if ($this->checkIfSafe($valueArray)) {
                    $safeLevels++;
                    break;
                }
            }
        }

        return (string)$safeLevels;
    }
}
