<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D9')]
class D9Service implements DayServiceInterface
{
    public function generatePart1(array $rows): string
    {
        $result = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $rowParts = explode(' ', $row);
            $nextNumber = $this->findNextNumber($rowParts);
            $result += $nextNumber;
        }

        return (string)$result;
    }

    public function generatePart2(array $rows): string
    {
        $result = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $rowParts = array_reverse(explode(' ', $row));
            $nextNumber = $this->findNextNumber($rowParts);
            $result += $nextNumber;
        }

        return (string)$result;
    }

    private function findNextNumber(array $rowParts): int
    {
        $lastDiffNr = end($rowParts);
        $diffArray = $this->getDiffArray($rowParts);
        $diffData = array_count_values($diffArray);
        if (count($diffData) === 1 && isset($diffData[0])) {
            return 0 + $lastDiffNr;
        }
        return $this->findNextNumber($diffArray) + $lastDiffNr;
    }

    private function getDiffArray(array $rowParts): array
    {
        $diffArray = [];
        foreach ($rowParts as $i => $iValue) {
            if ($i-1<0) {
                continue;
            }
            $diffArray[] = $iValue - $rowParts[$i-1];
        }

        return $diffArray;
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}
