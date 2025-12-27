<?php

namespace App\Service\Days\Year2025;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2025D5')]
class D5Service implements DayServiceInterface
{
    private array $ranges = [];
    private array $combinedRanges = [];
    private array $ingredients = [];
    private array $freshIngredients = [];
    private int $totalFreshIds = 0;

    public function generatePart1(array $rows): string
    {
        $this->makeInput($rows);
        $this->checkFreshness();

        return count($this->freshIngredients);
    }

    public function generatePart2(array $rows): string
    {
        $this->makeInput($rows);
        $this->combineRanges();
        $this->calculateTotalFreshIds();

        return $this->totalFreshIds;
    }

    private function calculateTotalFreshIds(): void
    {
        foreach ($this->combinedRanges as $start => $end) {
            $this->totalFreshIds += ($end - $start) + 1;
        }
    }

    private function combineRanges(): void
    {
        $rangeList = $this->ranges;
        while (!empty($rangeList)) {
            $range = array_shift($rangeList);

            if (empty($this->combinedRanges)) {
                $this->combinedRanges[$range['start']] = $range['end'];
                continue;
            }

            foreach ($this->combinedRanges as $combinedStart => $combinedEnd) {
                if ($range['start'] <= $combinedStart) {
                    if ($range['end'] >= $combinedEnd) {
                        $rangeList[] = $range;
                        unset($this->combinedRanges[$combinedStart]);
                        continue 2;
                    }
                    if ($range['end'] >= $combinedStart) {
                        $rangeList[] = [
                            'start' => $range['start'],
                            'end' => $combinedEnd
                        ];
                        unset($this->combinedRanges[$combinedStart]);
                        continue 2;
                    }
                }
                if ($range['start'] >= $combinedStart && $range['start'] <= $combinedEnd) {
                    if ($range['end'] <= $combinedEnd) {
                        continue 2;
                    }
                    if ($range['end'] >= $combinedEnd) {
                        $rangeList[] = [
                            'start' => $combinedStart,
                            'end' => $range['end']
                        ];
                        unset($this->combinedRanges[$combinedStart]);
                        continue 2;
                    }
                }
            }

            $this->combinedRanges[$range['start']] = $range['end'];
        }
    }

    private function checkFreshness(): void
    {
        foreach ($this->ingredients as $ingredient) {
            if ($this->isFresh($ingredient)) {
                $this->freshIngredients[] = $ingredient;
            }
        }
    }

    private function isFresh(string $ingredient): bool
    {
        foreach ($this->ranges as $range) {
            if ($ingredient >= $range['start'] && $ingredient <= $range['end']) {
                return true;
            }
        }

        return false;
    }

    private function makeInput(array $rows): void
    {
        $i = 'ranges';
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                if ($i === 'ranges') {
                    $i = 'ingredients';
                }
                continue;
            }

            if ($i === 'ranges') {
                [$startRange,$endRange] = explode('-',$row);
                $this->ranges[] = [
                    'start' => $startRange,
                    'end' => $endRange
                ];
            } elseif ($i === 'ingredients') {
                $this->ingredients[] = $row;
            }
        }
    }

    public function isValidInput(array $rows): bool
    {
        $check = 'range';
        foreach ($rows as $row) {
            if (empty($row)) {
                $check = 'ingredient';
                continue;
            }
            if ($check === 'range') {
                preg_match('/^\d+-\d+$/', $row, $matches);
                if (empty($matches)) {
                    return false;
                }
            } else {
                preg_match('/^\d+$/', $row, $matches);
                if (empty($matches)) {
                    return false;
                }
            }
        }
        return true;
    }
}