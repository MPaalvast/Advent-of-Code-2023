<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D2')]
class D2Service implements DayServiceInterface
{
    private int $minDiff = 1;
    private int $maxDiff = 3;

    public function generatePart1(array $rows): string
    {
        return $this->calculateSafeLevels($rows);
    }

    public function generatePart2(array $rows): string
    {
        return $this->calculateSafeDampenerLevels($rows);
    }

    //
    // helper functions below
    //

    private function calculateSafeLevels(array $rows): string
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
                $diff < $this->minDiff ||
                $diff > $this->maxDiff
            ) {
                return false;
            }
            $locationA = $locationB;
        }

        return true;
    }

    private function calculateSafeDampenerLevels(array $rows): string
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

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}
