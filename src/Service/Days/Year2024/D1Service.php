<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
#[AsTaggedItem('Y2024D1')]
class D1Service implements DayServiceInterface
{
    private string $title = "Historian Hysteria";
    private const COLUMN_DELIMITER = "   ";
    private const ROW_CLEANUP_REGEX = '/\r+/';
    private const EMPTY_COLUMN_DATA = ['left' => [], 'right' => []];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        return (string)$this->calculateDifference($rows);
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return (string)$this->calculateSum($rows);
    }

    private function calculateDifference(array|\Generator $rows): int
    {
        $columns = $this->buildColumnData($rows);

        return $this->calculateDiff($columns);
    }

    private function calculateSum(array|\Generator $rows): int
    {
        $columns = $this->buildColumnData($rows);

        return $this->calculateTotalSum($columns);
    }

    private function buildColumnData(array|\Generator $rows): array
    {
        $columnData = self::EMPTY_COLUMN_DATA;

        foreach ($rows as $row) {
            $processedRow = $this->processRow($row);
            if ($processedRow === null) {
                continue;
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
}
