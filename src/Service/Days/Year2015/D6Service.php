<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D6')]
class D6Service implements DayServiceInterface
{
    private int $total = 0;
    private array $lightsOn = [];

    public function generatePart1(array $rows): string
    {
        $this->handleRows($rows);
        $this->getTotalOn();
        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->handleLevelsRows($rows);
        $this->calculateBrightnessLevel();
        return $this->total;
    }

    /**
     * Sum all the brightness levels in the lightsOn array
     */
    private function calculateBrightnessLevel(): void
    {
        foreach ($this->lightsOn as $rowData) {
            $this->total += array_sum($rowData);
        }
    }

    private function handleLevelsRows(array $rows): void
    {
        foreach ($rows as $row) {
            $rowParts = explode(" ", $row);
            if ($rowParts[0] === 'toggle') {
                [$startX, $startY] = explode(',', $rowParts[1]);
                [$endX, $endY] = explode(',', $rowParts[3]);
                $this->addLevel($startX, $startY, $endX, $endY, 2);
            } else {
                [$startX, $startY] = explode(',', $rowParts[2]);
                [$endX, $endY] = explode(',', $rowParts[4]);
                if ($rowParts[1] === 'on') {
                    $this->addLevel($startX, $startY, $endX, $endY);
                } else {
                    $this->removeLevel($startX, $startY, $endX, $endY);
                }
            }
        }
    }

    /**
     * Adds the $brightness level to the lights
     */
    private function addLevel(int $startX, int $startY, int $endX, int $endY, $brightness = 1): void
    {
        for ($i = $startX; $i <= $endX; $i++) {
            if (!isset($this->lightsOn[$i])) {
                $this->lightsOn[$i] = [];
            }
            for ($j = $startY; $j <= $endY; $j++) {
                if (!isset($this->lightsOn[$i][$j])) {
                    $this->lightsOn[$i][$j] = 0;
                }
                $this->lightsOn[$i][$j] += $brightness;
            }
        }
    }

    /**
     * Removes 1 level of brightness from the lights and removes the value if it is 0
     */
    private function removeLevel(int $startX, int $startY, int $endX, int $endY): void
    {
        for ($i = $startX; $i <= $endX; $i++) {
            for ($j = $startY; $j <= $endY; $j++) {
                if (isset($this->lightsOn[$i][$j])) {
                    $this->lightsOn[$i][$j] -= 1;
                    if ($this->lightsOn[$i][$j] <= 0) {
                        unset($this->lightsOn[$i][$j]);
                    }
                }
            }
        }
    }

    /**
     * Calculates total lights that are in the lightsOn array
     */
    private function getTotalOn(): void
    {
        foreach ($this->lightsOn as $rowData) {
            $this->total += count($rowData);
        }
    }

    private function handleRows(array $rows): void
    {
        foreach ($rows as $row) {
            $rowParts = explode(" ", $row);
            if ($rowParts[0] === 'toggle') {
                [$startX, $startY] = explode(',', $rowParts[1]);
                [$endX, $endY] = explode(',', $rowParts[3]);
                $this->toggle($startX, $startY, $endX, $endY);
            } else {
                [$startX, $startY] = explode(',', $rowParts[2]);
                [$endX, $endY] = explode(',', $rowParts[4]);
                if ($rowParts[1] === 'on') {
                    $this->turnOn($startX, $startY, $endX, $endY);
                } else {
                    $this->turnOff($startX, $startY, $endX, $endY);
                }
            }
        }
    }

    /**
     * Adds lights that are nog in the array
     */
    private function turnOn(int $startX, int $startY, int $endX, int $endY): void
    {
        for ($i = $startX; $i <= $endX; $i++) {
            for ($j = $startY; $j <= $endY; $j++) {
                $this->lightsOn[$i][$j] = true;
            }
        }
    }

    /**
     * Removes the on lights in the array
     */
    private function turnOff(int $startX, int $startY, int $endX, int $endY): void
    {
        for ($i = $startX; $i <= $endX; $i++) {
            for ($j = $startY; $j <= $endY; $j++) {
                if (isset($this->lightsOn[$i][$j])) {
                    unset($this->lightsOn[$i][$j]);
                }
            }
        }
    }

    /**
     * Removes the on lights from the array and add the lights that are nog in the array
     */
    private function toggle(int $startX, int $startY, int $endX, int $endY): void
    {
        for ($i = $startX; $i <= $endX; $i++) {
            for ($j = $startY; $j <= $endY; $j++) {
                if (isset($this->lightsOn[$i][$j])) {
                    unset($this->lightsOn[$i][$j]);
                } else {
                    $this->lightsOn[$i][$j] = true;
                }
            }
        }
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}