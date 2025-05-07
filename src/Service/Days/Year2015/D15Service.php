<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D15')]
class D15Service implements DayServiceInterface
{
    private int $total = 0;
    private string $caloriesProperty = 'calories';
    private int $caloriesLimit = 0;
    private int $spoons = 100;
    private array $input = [];
    private array $properties = [];

    public function generatePart1(array $rows): string
    {
        $this->initInput($rows);
        $this->generateTotal();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->initInput($rows);
        $this->caloriesLimit = 500;
        $this->generateTotal();

        return $this->total;
    }

    private function generateTotal(): void
    {
        for ($z=0;$z<=$this->spoons;$z++) {
            for ($y=0;$y<=$this->spoons-$z;$y++) {
                for ($x=0;$x<=$this->spoons-$z-$y;$x++) {
                    $w = $this->spoons-$x-$y-$z;
                    $values = [$z,$y,$x,$w];

                    $score = [];
                    foreach (array_keys($this->properties) as $propertyKey) {
                        $score[] = $this->calculateResult($propertyKey, $values);
                    }

                    $scoreResult = 1;
                    foreach ($score as $scoreItem) {
                        if ($scoreItem <= 0) {
                            continue(2);
                        }
                    }

                    foreach ($score as $key => $scoreItem) {
                        if ($this->properties[$key] !== $this->caloriesProperty) {
                            $scoreResult *= $scoreItem;
                        } elseif ($this->caloriesLimit > 0 && $scoreItem !== $this->caloriesLimit) {
                            continue(2);
                        }
                    }

                    if ($scoreResult > $this->total) {
                        $this->total = $scoreResult;
                    }
                }
            }
        }
    }

    private function calculateResult(int $nr, array $values): int
    {
        $totalRows = count($this->input);
        $result = 0;

        for ($i=0;$i<$totalRows;$i++) {
            $result += $this->input[$i][$nr]*$values[$i];
        }

        return $result;
    }

    private function initInput(array $rows): void
    {
        foreach ($rows as $key => $line) {
            if (preg_match('/^\w+: \w+ (-?\d+), \w+ (-?\d+), \w+ (-?\d+), \w+ (-?\d+), \w+ (-?\d+)$/', $line, $matches)) {
                [$full, $value1, $value2, $value3, $value4, $value5] = $matches;
                $this->input[] = [
                    (int)$value1,
                    (int)$value2,
                    (int)$value3,
                    (int)$value4,
                    (int)$value5,
                ];

                if ($key === 0) {
                    preg_match('/^\w+: (\w+) -?\d+, (\w+) -?\d+, (\w+) -?\d+, (\w+) -?\d+, (\w+) -?\d+$/', $rows[0], $matches);
                    [$full, $property1, $property2, $property3, $property4, $property5] = $matches;
                    $this->properties = [
                        $property1,
                        $property2,
                        $property3,
                        $property4,
                        $property5,
                    ];
                }
            }
        }
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^\w+: \w+ (-?\d+), \w+ (-?\d+), \w+ (-?\d+), \w+ (-?\d+), \w+ (-?\d+)$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}