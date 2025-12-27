<?php

namespace App\Service\Days\Year2025;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2025D3')]
class D3Service implements DayServiceInterface
{
    private array $voltagesList = [];

    public function generatePart1(array $rows): string
    {
        $this->listAllVoltages($rows);
        return array_sum($this->voltagesList);
    }

    public function generatePart2(array $rows): string
    {
        $this->listAllVoltages($rows, true);
        return array_sum($this->voltagesList);
    }

    private function listAllVoltages(array $rows, bool $findBigVoltage = false): void
    {
        foreach ($rows as $row) {
            if (!$findBigVoltage) {
                $this->findVoltage($row);
            } else {
                $this->findBigVoltage($row);
            }
        }
    }

    private function findBigVoltage(string $row): void
    {
        while (strlen($row) > 12) {
            $checkNumber = substr($row, 0, -1);
            for ($i=0, $iMax = strlen($row); $i< $iMax; $i++) {
                $newNumber = substr_replace($row, '', $i, 1);
                if ($newNumber >= $checkNumber) {
                    $row = (string)$newNumber;
                    continue 2;
                }
            }
            $row = substr($row, 0, 12);
        }
        $this->addVoltage((int)$row);
    }

    private function findVoltage(string $row): void
    {
        $left = 0;
        $right = 0;
        for ($i=0; $i<2; $i++) {
            for ($y=9; $y>0; $y--) {
                if (str_contains($row,$y)) {
                    [$leftPart, $rightPart] = explode($y, $row, 2);
                    if (empty($rightPart)) {
                        if ($right === 0) {
                            $right = $y;
                        } else {
                            $left = $y;
                        }
                        $row = $leftPart;
                    } else {
                        if ($left === 0) {
                            $left = $y;
                        } else {
                            $right = $y;
                        }
                        $row = $rightPart;
                    }

                    continue 2;
                }
            }
        }
        $this->addVoltage((int)($left.$right));
    }

    private function addVoltage(int $voltage): void
    {
        $this->voltagesList[] = $voltage;
    }


    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^(\d+)$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}