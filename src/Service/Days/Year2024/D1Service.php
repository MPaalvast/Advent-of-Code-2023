<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
#[AsTaggedItem('Y2024D1')]
class D1Service implements DayServiceInterface
{
    private const COLUMN_DELIMITER = "   ";
    private const ROW_CLEANUP_REGEX = '/\r+/';
    private const EMPTY_COLUMN_DATA = ['left' => [], 'right' => []];

    public function generatePart1(array $rows): string
    {
        return $this->calculateDifference($rows);
    }

    public function generatePart2(array $rows): string
    {
        return $this->calculateSum($rows);
    }

    private function calculateDifference(array $rows): string
    {
        $columns = $this->buildColumnData($rows);

        if ($columns === null) {
            return "Invalid input";
        }

        return (string)$this->calculateDiff($columns);
    }

    private function calculateSum(array $rows): string
    {
        $columns = $this->buildColumnData($rows);

        if ($columns === null) {
            return "Invalid input";
        }

        return (string)$this->calculateTotalSum($columns);
    }

    private function buildColumnData(array $rows):? array
    {
        $columnData = self::EMPTY_COLUMN_DATA;

        foreach ($rows as $row) {
            $processedRow = $this->processRow($row);
            if ($processedRow === null) {
                continue;
            }
            if (count($processedRow) !== 2) {
                return null;
            }
            [$left, $right] = $processedRow;
            $columnData['left'][] = $left;
            $columnData['right'][] = $right;
        }

        return $columnData;
    }

    private function processRow(string $row): ?array
    {
        $cleanedRow = trim(preg_replace(self::ROW_CLEANUP_REGEX, '', $row));
        if (empty($cleanedRow)) {
            return null;
        }

        return explode(self::COLUMN_DELIMITER, $cleanedRow);
    }

    private function calculateDiff(array $columnData): int
    {
        $left = $columnData['left'];
        $right = $columnData['right'];
        sort($left);
        sort($right);

        $difference = 0;
        foreach ($left as $key => $leftValue) {
            $difference += abs($leftValue - $right[$key]);
        }

        return $difference;
    }

    private function calculateTotalSum(array $columnData): int
    {
        $left = $columnData['left'];
        $right = $columnData['right'];

        $sum = 0;
        foreach ($left as $leftValue) {
            $sum += count(array_keys($right, $leftValue)) * $leftValue;
        }

        return $sum;
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}
