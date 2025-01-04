<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\Dijkstra\Dijkstra;
use App\Service\Tools\Dijkstra\DijkstraWithTurnPenalty;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D18')]
class D18Service implements DayServiceInterface
{
    private int $total = 0;
    private array $badLocations = [];
    private array $grid = [];
    private array $dijkstraGrid = [];
    private string $startPoint = '0-0';
    private string $endPoint = '0-0';

    public function generatePart1(array|\Generator $rows): string
    {
        $this->loadBadLocations($rows);
        $size = count($this->badLocations) < 30 ? 6 : 70;
        $totalBites = count($this->badLocations) < 30 ? 12 : 3449;
        $this->endPoint = $size . '-' . $size;
        $this->buildGrid($size);
        $this->addBadLocations($totalBites);
        $this->generateDijkstraInput();
        $dijkstra = new Dijkstra($this->dijkstraGrid, $this->startPoint, true);
        $shortest_path = $dijkstra->shortestPathTo($this->endPoint);
        $this->setTotal($shortest_path);

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $this->loadBadLocations($rows);
        $size = count($this->badLocations) < 30 ? 6 : 70;
        $this->endPoint = $size . '-' . $size;
        $this->buildGrid($size);

        return $this->findBreakingBit();
    }

    private function loadBadLocations(array|\Generator  $rows): void
    {
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $this->badLocations[] = $row;
        }
    }

    private function buildGrid(int $size): void
    {
        for ($i = 0; $i <= $size; $i++) {
            for ($j = 0; $j <= $size; $j++) {
                $this->grid[$i][$j] = '.';
            }
        }
    }

    private function generateDijkstraInput(): void
    {
        $this->dijkstraGrid = [];
        foreach ($this->grid as $x => $row) {
            foreach ($row as $y => $value) {
                $index = $x . '-' . $y;
                if ($value === '.') {
                    $this->dijkstraGrid[$index] = [];
                    $this->setDijkstraGridField($x-1, $y, $index);
                    $this->setDijkstraGridField($x+1, $y, $index);
                    $this->setDijkstraGridField($x, $y-1, $index);
                    $this->setDijkstraGridField($x, $y+1, $index);
                }
            }
        }
    }

    /**
     * @param int $x
     * @param int $y
     * @param string $index
     *
     * @return void
     */
    private function setDijkstraGridField(int $x, int $y, string $index): void
    {
        if (isset($this->grid[$x][$y]) && $this->grid[$x][$y] === '.') {
            $this->dijkstraGrid[$index][$x . '-' . $y] = 1;
        }
    }

    private function addBadLocations(int $totalBites): void
    {
        for ($i = 0; $i < $totalBites; $i++) {
            $this->addBadSectorToGrid($this->badLocations[$i]);
        }
    }

    private function setTotal(array $shortest_path): void
    {
        $lastItem = end($shortest_path);
        $this->total = $lastItem['accumulated_weight'];
    }

    private function findBreakingBit(): string
    {
        $grid = $this->grid;
        $lastBadLocation = '';
        while (true) {
            $this->addBadLocations(count($this->badLocations));
            $this->generateDijkstraInput();
            $dijkstra = new Dijkstra($this->dijkstraGrid, $this->startPoint, true);
            if ($dijkstra->shortestPathTo($this->endPoint) !== false) {
                break;
            }
            $this->grid = $grid;
            $lastBadLocation = array_pop($this->badLocations);
        }

        return $lastBadLocation;
    }

    private function addBadSectorToGrid(mixed $badLocation): void
    {
        [$badX, $badY] = array_map('intval', explode(',', $badLocation));
        $this->grid[$badX][$badY] = '#';
    }
}