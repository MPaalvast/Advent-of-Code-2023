<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D8')]
class Y2024D8Service implements DayServiceInterface
{
    private string $title = "Resonant Collinearity";

    private array $grid = [];

    private array $foundNodes = [];

    private array $frequencies = [];

    private int $total = 0;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->generateGrid($rows);
        $this->calculateAntinodes();

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $this->generateGrid($rows);
        $this->calculateAntinodes(true);

        return $this->total;
    }

    //
    // helper functions below
    //

    private function generateGrid(array|\Generator  $rows): void
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

    private function findTotalNodes(array $frequencyArray): void
    {
        while (!empty($frequencyArray)) {
            $node = array_shift($frequencyArray);
            foreach ($frequencyArray as $frequencyPoint) {
                $diffX = $node['x'] - $frequencyPoint['x'];
                $diffY = $node['y'] - $frequencyPoint['y'];

                $this->isValidNode(
                    $node['x'] + $diffX,
                    $node['y'] + $diffY
                );
                $this->isValidNode(
                    $frequencyPoint['x'] + ($diffX >= 0 ? ($diffX * -1) : abs($diffX)),
                    $frequencyPoint['y'] + ($diffY >= 0 ? ($diffY * -1) : abs($diffY))
                );
            }
        }
    }

    private function findTotalNodesRepeating(array $frequencyArray): void
    {
        while (!empty($frequencyArray)) {
            $node = array_shift($frequencyArray);
            foreach ($frequencyArray as $frequencyPoint) {
                $diff = [
                    'x' => $node['x'] - $frequencyPoint['x'],
                    'y' => $node['y'] - $frequencyPoint['y']
                ];

                $this->findAntinodes($node, $diff);
                $this->findAntinodes($frequencyPoint, $diff);
            }
        }
    }

    private function findAntinodes(array $node, array $diff): void
    {
        $x = $node['x'];
        $y = $node['y'];
        while (true) {
            $calculatedX = $x + $diff['x'];
            $calculatedY = $y + $diff['y'];
            if (!$this->isValidNode($calculatedX, $calculatedY)) {
                break;
            }
            $x = $calculatedX;
            $y = $calculatedY;
        }

        $x = $node['x'];
        $y = $node['y'];
        while (true) {
            $calculatedX = $x + ($diff['x'] >= 0 ? ($diff['x'] * -1) : abs($diff['x']));
            $calculatedY = $y + ($diff['y'] >= 0 ? ($diff['y'] * -1) : abs($diff['y']));
            if (!$this->isValidNode($calculatedX, $calculatedY)) {
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
}