<?php

namespace App\Service\Days\Year2025;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2025D9')]
class D9Service implements DayServiceInterface
{
    private array $input = [];
    private int $total = 0;
    public function generatePart1(array $rows): string
    {
        $this->setInput($rows);
        $this->findBiggestSquare();
        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        // maak een vierkant en haal alle 4 de hoekpunten op.
        // controleer of alle hoekpunten binnen de polygon liggen
        return $this->total;
    }

    private function findBiggestSquare(): void
    {
        $biggestSquare = 0;
        $inputs = $this->input;
        while (!empty($inputs)) {
            $row = array_shift($inputs);
            $this->calculateBiggestSquare($row, $inputs, $biggestSquare);
        }

        $this->total = $biggestSquare;
    }

    private function calculateBiggestSquare(array $row, array $inputs, int &$biggestSquare): void
    {
        foreach ($inputs as $input) {
            $x = abs($row['x'] - $input['x']) + 1;
            $y = abs($row['y'] - $input['y']) + 1;
            $square = (int)($x * $y);
            if ($square > $biggestSquare) {
                $biggestSquare = $square;
            }
        }
    }

    private function setInput(array $rows): void
    {
        foreach ($rows as $row) {
            [$x, $y] = explode(',', $row);
            $this->input[] = [
                'x' => $x,
                'y' => $y
            ];
        }
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^\d+,\d+$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}