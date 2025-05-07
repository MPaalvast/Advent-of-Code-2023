<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D16')]
class D16Service implements DayServiceInterface
{
    private int $total = 0;
    private array $input = [];
    private array $rangeGreaterThan = [];
    private array $rangeLessThan = [];
    private array $MFCSAMResult = [
        'children' => 3,
        'cats' => 7,
        'samoyeds' => 2,
        'pomeranians' => 3,
        'akitas' => 0,
        'vizslas' => 0,
        'goldfish' => 5,
        'trees' => 3,
        'cars' => 2,
        'perfumes' => 1,
    ];

    public function generatePart1(array $rows): string
    {
        $this->initInput($rows);
        $this->findSue();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->initInput($rows);
        $this->rangeGreaterThan = ['cats', 'trees'];
        $this->rangeLessThan = ['pomeranians', 'goldfish'];
        $this->findSue();

        return $this->total;
    }

    private function findSue(): void
    {
        foreach ($this->input as $sueNr => $data) {
            foreach ($data as $key => $value) {
                if (in_array($key, $this->rangeGreaterThan, true)) {
                    if ($this->MFCSAMResult[$key] > $value) {
                        continue(2);
                    }
                } elseif (in_array($key, $this->rangeLessThan, true)) {
                    if ($this->MFCSAMResult[$key] < $value) {
                        continue(2);
                    }
                } elseif ($this->MFCSAMResult[$key] !== $value) {
                    continue(2);
                }
            }
            $this->total = $sueNr;
            break;
        }
    }
    private function initInput(array $rows): void
    {
        foreach ($rows as $key => $line) {
            if (preg_match('/^\w+ (\d+): (\w+): (\d+), (\w+): (\d+), (\w+): (\d+)$/', $line, $matches)) {
                [$full, $sueNr, $type1, $value1, $type2, $value2, $type3, $value3] = $matches;
                $this->input[$sueNr] = [
                    $type1 => (int)$value1,
                    $type2 => (int)$value2,
                    $type3 => (int)$value3,
                ];
            }
        }
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^\w+ (\d+): (\w+): (\d+), (\w+): (\d+), (\w+): (\d+)$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}