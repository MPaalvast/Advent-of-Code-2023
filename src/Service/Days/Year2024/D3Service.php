<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D3')]
class D3Service implements DayServiceInterface
{
    private int $total = 0;
    private string $inputString = '';

    public function generatePart1(array $rows): string
    {
        return $this->calculateMultiply($rows);
    }

    public function generatePart2(array $rows): string
    {
        return $this->calculateDoAndDontMultiply($rows);
    }

    //
    // helper functions below
    //

    private function calculateMultiply(array $rows): string
    {
        $this->makeInputString($rows);

        $multiplyData = $this->getMultiplyStrings($this->inputString);
        $this->handleMultiplyData($multiplyData);

        return (string)$this->total;
    }

    private function makeInputString(array $rows): void
    {
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }

            $this->inputString .= $row;
        }
    }

    private function getMultiplyStrings(string $row): array
    {
        preg_match_all('/(mul\()\d{1,3},\d{1,3}\)/', $row, $matches);

        return $matches[0];
    }

    private function handleMultiplyData(array $multiplyData): void
    {
        foreach ($multiplyData as $multiplyDataString) {
            [$x, $y] = explode(',', substr($multiplyDataString, 4, -1));
            $this->total += $x * $y;
        }
    }

    private function calculateDoAndDontMultiply(array $rows): string
    {
        $this->makeInputString($rows);

        $multiplyData = $this->getAllMultiply();
        $this->calculateAllMultiply($multiplyData);

        return (string)$this->total;
    }

    private function getAllMultiply(): array
    {
        $doArray = [];
        $dontExplode = explode('don\'t()', $this->inputString);
        $doArray[] = array_shift($dontExplode);
        if (!empty($dontExplode)) {
            foreach ($dontExplode as $dontRow) {
                $doExplode = explode('do()', $dontRow);
                array_shift($doExplode);
                foreach ($doExplode as $doRow) {
                    $doArray[] = $doRow;
                }
            }
        }

        return $doArray;
    }

    private function calculateAllMultiply(array $multiplyData): void
    {
        foreach ($multiplyData as $string) {
            $multiplyData = $this->getMultiplyStrings($string);
            $this->handleMultiplyData($multiplyData);
        }
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}