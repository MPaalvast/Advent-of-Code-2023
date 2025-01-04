<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D11')]
class D11Service implements DayServiceInterface
{
    private int $total = 0;
    private array $stones = [];
    private array $newStoneArray = [];
    private int $iterations = 25;

    public function generatePart1(array $rows): string
    {
        $this->getStones($rows);
        $this->calculateStonesTotal();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->iterations = 75;
        $this->getStones($rows);
        $this->calculateStonesTotal();

        return $this->total;
    }

    //
    // helper functions below
    //

    private function getStones(array $rows): void
    {
        foreach ($rows as $row) {
            $stones = explode(' ', $row);
            foreach ($stones as $stone) {
                if (!isset($this->stone[$stone])) {
                    $this->stones[$stone] = 1;
                } else {
                    $this->stones[$stone]++;
                }
            }
            break;
        }
    }
    public function calculateStonesTotal(): void
    {
        foreach ($this->stones as $stone => $count) {
            $stoneArray = [$stone => $count];
            $i = 0;
            while ($i < $this->iterations) {
                $this->newStoneArray = [];
                foreach ($stoneArray as $stoneNr => $total) {
                    $this->setNewStones($stoneNr, $total);
                }
                $stoneArray = $this->newStoneArray;
                $i++;
            }

            $this->total += array_sum($stoneArray);
        }
    }

    private function setNewStones(int $stoneNr, int $stoneTotal): void
    {
        if ($stoneNr === 0) {
            $this->addNewStone(1, $stoneTotal);
        } elseif (strlen($stoneNr)%2 === 0) {
            $newNrArray = $this->splitStone($stoneNr);
            foreach ($newNrArray as $newNr) {
                $this->addNewStone($newNr, $stoneTotal);
            }
        } else {
            $this->addNewStone($stoneNr * 2024, $stoneTotal);
        }
    }

    private function splitStone(int $stoneNr): array
    {
        $newNrArray = [];
        $newNrArray[] = (int)(substr($stoneNr, 0, (strlen($stoneNr)/2)));
        $newNrArray[] = (int)(substr($stoneNr, strlen($stoneNr)/2));

        return $newNrArray;
    }

    private function addNewStone(int $stoneNr, int $stoneTotal): void
    {
        if (!isset($this->newStoneArray[$stoneNr])) {
            $this->newStoneArray[$stoneNr] = $stoneTotal;
        } else {
            $this->newStoneArray[$stoneNr] += $stoneTotal;
        }
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}