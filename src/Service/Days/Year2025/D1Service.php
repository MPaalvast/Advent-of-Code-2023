<?php

namespace App\Service\Days\Year2025;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
#[AsTaggedItem('Y2025D1')]
class D1Service implements DayServiceInterface
{
    private const DIAL_MAX_NUMBER = 100;
    private int $currentPosition = 50;
    private int $result = 0;
    private int $pastZeroResult = 0;

    public function generatePart1(array $rows): string
    {
        $this->totalZeroPositions($rows);
        return $this->result;
    }

    public function generatePart2(array $rows): string
    {
        $this->totalZeroPositions($rows);
        return $this->result + $this->pastZeroResult;
    }

    private function totalZeroPositions(array $rows): void
    {
        foreach ($rows as $row) {
            $this->calculateResult($row);
        }
    }

    private function calculateResult(string $row): void
    {
        [$direction, $totalClicks] = $this->getRowParts($row);

        $timesPastZero = floor($totalClicks / self::DIAL_MAX_NUMBER);
        $this->pastZeroResult += $timesPastZero;

        $totalClicks -= ($timesPastZero * self::DIAL_MAX_NUMBER);
        $oldPosition = $this->currentPosition;

        if ($direction === 'L') {
            $this->currentPosition -= $totalClicks;
        } else {
            $this->currentPosition += $totalClicks;
        }
        if ($oldPosition !== 0 && ($this->currentPosition < 0 || $this->currentPosition > self::DIAL_MAX_NUMBER)) {
            $this->pastZeroResult++;
        }
        if ($this->isZeroPosition()) {
            $this->result++;
        }
    }

    private function isZeroPosition(): bool
    {
        if (abs($this->currentPosition) >= self::DIAL_MAX_NUMBER) {
            $this->currentPosition %= self::DIAL_MAX_NUMBER;
        }
        if ($this->currentPosition < 0) {
            $this->currentPosition = 100 - abs($this->currentPosition);
        }

        return $this->currentPosition === 0;
    }

    private function getRowParts(string $row): array
    {
        return [$row[0], substr($row, 1, )];
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^[L|R]\d+$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}
