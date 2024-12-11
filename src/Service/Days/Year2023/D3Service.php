<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D3')]
class D3Service implements DayServiceInterface
{
    private string $title = "Gear Ratios";

    public function getTitle(): string
    {
        return $this->title;
    }
    public function generatePart1(array|\Generator $rows): string
    {
        $arrayInput = $this->makeArrayInput($rows);
        $numbersToCount = $this->listNumbersToCount($arrayInput);

        return (string)array_sum($numbersToCount);
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $arrayInput = $this->makeArrayInput($rows);
        $numbersToCount = $this->listNumbersToCountByStar($arrayInput);

        return (string)array_sum($numbersToCount);
    }

    private function makeArrayInput(array|\Generator$input): array
    {
        $outputArray = [];
        $i = 0;
        foreach ($input as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            $outputArray[$i] = str_split($row);
            $i++;
        }

        return $outputArray;
    }

    private function listNumbersToCount(array $arrayInput): array
    {
        $numbersToCount = [];

        foreach ($arrayInput as $y => $yValue) {
            $number = '';
            $isCounting = false;

            foreach ($yValue as $i => $iValue) {
                if (is_numeric($iValue)) {
                    if (!$isCounting) {
                        $isCounting = $this->checkCounting($y, $i, $arrayInput);
                    }
                    $number .= $iValue;
                    if (!isset($yValue[($i + 1)]) || !is_numeric($yValue[($i + 1)])) {
                        if ($isCounting) {
                            $numbersToCount[] = $number;
                        }
                        $isCounting = false;
                        $number = '';
                    }
                }
            }
        }

        return $numbersToCount;
    }

    private function checkCounting(int $y, int $i, array $arrayInput): bool
    {
        if ($y > 0) {
            if (($i > 0) && $this->checkFieldToCount($arrayInput[($y - 1)][($i - 1)])) {
                return true;
            }
            if ($this->checkFieldToCount($arrayInput[($y-1)][($i)])) {
                return true;
            }

            if ((($i + 1) < count($arrayInput[$y])) && $this->checkFieldToCount($arrayInput[($y - 1)][($i + 1)])) {
                return true;
            }
        }
        if (($i > 0) && $this->checkFieldToCount($arrayInput[($y)][($i - 1)])) {
            return true;
        }
        if ((($i + 1) < count($arrayInput[$y])) && $this->checkFieldToCount($arrayInput[($y)][($i + 1)])) {
            return true;
        }
        if (($y+1) < count($arrayInput)) {
            if (($i > 0) && $this->checkFieldToCount($arrayInput[($y + 1)][($i - 1)])) {
                return true;
            }
            if ($this->checkFieldToCount($arrayInput[($y + 1)][($i)])) {
                return true;
            }

            if ((($i + 1) < count($arrayInput[$y])) && $this->checkFieldToCount($arrayInput[($y + 1)][($i + 1)])) {
                return true;
            }
        }
        return false;
    }

    private function checkFieldToCount($field): bool
    {
        return !is_numeric($field) && $field !== '.';
    }

    private function listNumbersToCountByStar(array $arrayInput): array
    {
        $numbersToCount = [];

        foreach ($arrayInput as $y => $yValue) {
            foreach ($yValue as $i => $iValue) {
                if ($iValue === '*') {
                    $numbers = $this->getNumbers($y, $i, $arrayInput);
                    if (count($numbers) === 2) {
                        dump($numbers);
                        $numbersToCount[] = $numbers[0] * $numbers[1];
                    }
                }
            }
        }

        return $numbersToCount;
    }

    private function getNumbers(int $y, int $i, array $arrayInput): array
    {
        $numbers = [];

        if (isset($arrayInput[($y - 1)][($i)]) && !is_numeric($arrayInput[($y - 1)][($i)])) {
            if (isset($arrayInput[($y - 1)][($i - 1)]) && is_numeric($arrayInput[($y - 1)][($i - 1)])) {
                $numbers[] = $this->getTotalNumber($y-1, $i-1, $arrayInput);
            }
            if (isset($arrayInput[($y - 1)][($i + 1)]) && is_numeric($arrayInput[($y - 1)][($i + 1)])) {
                $numbers[] = $this->getTotalNumber($y-1, $i+1, $arrayInput);
            }
        } elseif (isset($arrayInput[($y - 1)][($i)]) && is_numeric($arrayInput[($y - 1)][$i])) {
            $numbers[] = $this->getTotalNumber($y-1, $i, $arrayInput);
        }

        if (isset($arrayInput[($y)][($i-1)]) && is_numeric($arrayInput[($y)][($i-1)])) {
            $numbers[] = $this->getTotalNumber($y, $i-1, $arrayInput);
        }
        if (isset($arrayInput[($y)][($i+1)]) && is_numeric($arrayInput[($y)][($i+1)])) {
            $numbers[] = $this->getTotalNumber($y, $i+1, $arrayInput);
        }

        if (isset($arrayInput[($y + 1)][($i)]) && !is_numeric($arrayInput[($y + 1)][($i)])) {
            if (isset($arrayInput[($y + 1)][($i - 1)]) && is_numeric($arrayInput[($y + 1)][($i - 1)])) {
                $numbers[] = $this->getTotalNumber($y+1, $i-1, $arrayInput);
            }
            if (isset($arrayInput[($y + 1)][($i + 1)]) && is_numeric($arrayInput[($y + 1)][($i + 1)])) {
                $numbers[] = $this->getTotalNumber($y+1, $i+1, $arrayInput);
            }
        } elseif (isset($arrayInput[($y + 1)][($i)]) && is_numeric($arrayInput[($y + 1)][$i])) {
            $numbers[] = $this->getTotalNumber($y+1, $i, $arrayInput);
        }

        return $numbers;
    }

    private function getTotalNumber(int $y, int $i, array $arrayInput): int
    {
        $number = $arrayInput[$y][$i];
        for ($index = $i-1; isset($arrayInput[$y][$index]); $index--) {
            if (is_numeric($arrayInput[$y][$index])) {
                $number = $arrayInput[$y][$index] . $number;
            } else {
                break;
            }
        }
        for ($index = $i+1; isset($arrayInput[$y][$index]); $index++) {
            if (is_numeric($arrayInput[$y][$index])) {
                $number .= $arrayInput[$y][$index];
            } else {
                break;
            }
        }

        return (int)$number;
    }
}
