<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D8')]
class D8Service implements DayServiceInterface
{
    private array $grid = [];
    private array $foundNodes = [];
    private array $frequencies = [];
    private int $total = 0;

    public function generatePart1(array $rows): string
    {
        $this->generateGrid($rows);
        $this->calculateAntinodes();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->generateGrid($rows);
        $this->calculateAntinodes(true);

        return $this->total;
    }

    //
    // helper functions below
    //

    private function generateGrid(array  $rows): void
    {
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $gridRow = str_split($row);

            foreach ($gridRow as $y => $rowYValue) {
                if ($rowYValue !== '.') {
                    $this->frequencies[$rowYValue][] = ['x' => $x, 'y' => $y];
                }
            }
            $this->grid[] = $gridRow;
        }
    }

    private function calculateAntinodes(bool $repeating = false): void
    {
        foreach ($this->frequencies as $frequencyArray) {
            if ($repeating) {
                $this->findTotalNodesRepeating($frequencyArray);
            } else {
                $this->findTotalNodes($frequencyArray);
            }
        }

        $this->total = count($this->foundNodes);
    }

    private function getDiffCoordinates(array $pointA, array $pointB): array
    {
        return [
            'x' => $pointA['x'] - $pointB['x'],
            'y' => $pointA['y'] - $pointB['y'],
        ];
    }

    private function findTotalNodes(array $frequencyArray): void
    {
        while (!empty($frequencyArray)) {
            $node = array_shift($frequencyArray);
            foreach ($frequencyArray as $frequencyPoint) {
                $diff = $this->getDiffCoordinates($node, $frequencyPoint);

                $this->findValidNodesLoop($node, $diff, false, false);
                $this->findValidNodesLoop($frequencyPoint, $diff, true, false);
            }
        }
    }

    private function findTotalNodesRepeating(array $frequencyArray): void
    {
        while (!empty($frequencyArray)) {
            $node = array_shift($frequencyArray);
            foreach ($frequencyArray as $frequencyPoint) {
                $diff = $this->getDiffCoordinates($node, $frequencyPoint);

                $this->findAntinodes($node, $diff);
                $this->findAntinodes($frequencyPoint, $diff);
            }
        }
    }

    private function findAntinodes(array $node, array $diff): void
    {
        $this->findValidNodesLoop($node, $diff);
        $this->findValidNodesLoop($node, $diff, true);
    }

    private function findValidNodesLoop(array $node, array $diff, bool $calculateAbs = false, bool $keepsLooping = true): void
    {
        $x = $node['x'];
        $y = $node['y'];
        while (true) {
            if ($calculateAbs) {
                $calculatedX = $x + ($diff['x'] >= 0 ? ($diff['x'] * -1) : abs($diff['x']));
                $calculatedY = $y + ($diff['y'] >= 0 ? ($diff['y'] * -1) : abs($diff['y']));
            } else {
                $calculatedX = $x + $diff['x'];
                $calculatedY = $y + $diff['y'];
            }

            if (
                !$this->isValidNode($calculatedX, $calculatedY) ||
                !$keepsLooping
            ) {
                break;
            }
            $x = $calculatedX;
            $y = $calculatedY;
        }
    }

    private function isValidNode(int $x, int $y): bool
    {
        if (!isset($this->grid[$x][$y])) {
            return false;
        }
        $index = $x . '-' .$y;
        if (!in_array($index, $this->foundNodes, true)) {
            $this->foundNodes[] = $index;
        }

        return true;
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}