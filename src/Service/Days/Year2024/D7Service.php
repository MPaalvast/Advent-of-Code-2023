<?php

namespace App\Service\Days\Year2024;

use AllowDynamicProperties;
use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AllowDynamicProperties] #[AsTaggedItem('Y2024D7')]
class D7Service implements DayServiceInterface
{
    private int $total = 0;
    private int $expectedValue = 0;

    public function generatePart1(array $rows): string
    {
        $this->getCorrectResults($rows);

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->getCorrectResults($rows, true);

        return $this->total;
    }

    //
    // helper functions below
    //

    private function getCorrectResults(array $rows, bool $canMerge = false): void
    {
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }

            [$this->expectedValue, $stringFields] = explode(": ", $row);
            $valuesToCalculate = explode(" ", $stringFields);

            if ($canMerge) {
                if ($this->getCorrectPlusTimesMergeResults($valuesToCalculate)) {
                    $this->total += $this->expectedValue;
                }
            } else {
                if ($this->checkPlusTimesResult($valuesToCalculate)) {
                    $this->total += $this->expectedValue;
                }
            }
        }
    }

    private function checkPlusTimesResult(array $valuesToCalculate, int $currentValue = 0): bool
    {
        $value = array_shift($valuesToCalculate);
        if (empty($valuesToCalculate)) {
            if (
                $value+$currentValue === $this->expectedValue
                || $value*$currentValue === $this->expectedValue
            ) {
                return true;
            }

            return false;
        }

        if ($this->checkPlusTimesResult($valuesToCalculate, $value+$currentValue)
            || $this->checkPlusTimesResult($valuesToCalculate, $value*$currentValue)) {
            return true;
        }

        return false;
    }

    private function getCorrectPlusTimesMergeResults(array $valuesToCalculate, int $currentValue = 0): bool
    {
        $value = array_shift($valuesToCalculate);
        if (empty($valuesToCalculate)) {
            if (
                $value*$currentValue === $this->expectedValue
                || $value+$currentValue === $this->expectedValue
                || sprintf("%d%d", $currentValue, $value) === (string)$this->expectedValue
            ) {
                return true;
            }

            return false;
        }

        $mergeString = $value;
        if ($currentValue !== 0) {
            $mergeString = sprintf("%d%d", $currentValue, $value);
        }
        if (
            $this->getCorrectPlusTimesMergeResults($valuesToCalculate, (int)$mergeString)
            || $this->getCorrectPlusTimesMergeResults($valuesToCalculate, bcadd($value, $currentValue))
            || $this->getCorrectPlusTimesMergeResults($valuesToCalculate, bcmul($value, $currentValue))
        ) {
            return true;
        }

        return false;
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}