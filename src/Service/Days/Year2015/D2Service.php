<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D2')]
class D2Service implements DayServiceInterface
{
    private int $total = 0;
    private array $packages = [];

    public function generatePart1(array $rows): string
    {
        $this->initInput($rows);
        $this->getTotalWrappingPaper();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->initInput($rows);
        $this->getTotalRibbonPaper();

        return $this->total;
    }

    private function initInput(array $rows): void
    {
        foreach ($rows as $row) {
            [$length, $width, $height] = explode('x', $row);
            $this->packages[] = [
                'length' => $length,
                'width' => $width,
                'height' => $height,
            ];
        }
    }

    /**
     * input rows must contain {nr}x{nr}x{nr}
     */
    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^(\d+x\d+x\d+)$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }

    private function getTotalWrappingPaper(): void
    {
        foreach ($this->packages as $package) {
            $sides = $this->calculateSideWrappingPaper($package);
            $this->calculateTotalWrappingPaper($sides);
        }
    }

    /**
     * formula: length * width
     * formula: width * height
     * formula: height * length
     *
     * @return array<int>
     */
    private function calculateSideWrappingPaper(array $package): array
    {
        return [
            $package['length'] * $package['width'],
            $package['width'] * $package['height'],
            $package['height'] * $package['length'],
        ];
    }

    /**
     * formula: ((lengthWidthSurface + widthHeightSurface + heightLengthSurface) * 2) + smallestSideSurface
     */
    private function calculateTotalWrappingPaper(array $sides): void
    {
        $this->total += (array_sum($sides) * 2) + min($sides);
    }

    private function getTotalRibbonPaper(): void
    {
        foreach ($this->packages as $package) {
            $sides = $this->calculateRibbonPaper($package);
            $bow = $this->calculateRibbonBowPaper($package);
            $this->total += $sides + $bow;
        }
    }

    /**
     * Get the 2 smallest sides as side1 and side2
     * formula: side1 + side1 + side2 + side2
     */
    private function calculateRibbonPaper(array $package): int
    {
        $values = array_values($package);
        sort($values);
        [$side1, $side2] = $values;

        return $side1 + $side1 + $side2 + $side2;
    }

    /**
     * formula: length * width * height
     */
    private function calculateRibbonBowPaper(array $package): int
    {
        return $package['length'] * $package['width'] * $package['height'];
    }
}