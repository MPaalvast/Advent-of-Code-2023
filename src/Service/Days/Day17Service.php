<?php

declare(strict_types=1);

namespace App\Service\Days;

use App\Service\Tools\Dijkstra\Dijkstra;

class Day17Service implements DayServiceInterface
{
    public function __construct(public array $grid = [], public int $maxHeight = 0, public int $maxWidth = 0)
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->getGrid($rows);

        $dijkstraGrid = $this->createDijkstraGrid();
//dd($dijkstraGrid);
        $source = '0-0';

        $dijkstra = new Dijkstra($dijkstraGrid, $source, true);
        dd($dijkstra);
        $destination    = '12-12';
        $shortest_path1 = $dijkstra->shortestPathTo($destination);
        dd($shortest_path1);
        return 0;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return '0';
    }

    private function createDijkstraGrid(): array
    {
        $grid = [];
        for ($x=0;$x<$this->maxHeight;$x++) {
            for ($y=0;$y<$this->maxWidth;$y++) {
                $grid[$x.'-'.$y] = [];
                // top
                if ($x-1 >= 0) {
                    $grid[$x.'-'.$y][($x-1).'-'.$y] = $this->grid[($x-1)][$y];
                }
                // bottom
                if ($x+1 < $this->maxHeight) {
                    $grid[$x.'-'.$y][($x+1).'-'.$y] = $this->grid[($x+1)][$y];
                }
                // right
                if ($y+1 < $this->maxWidth) {
                    $grid[$x.'-'.$y][$x.'-'.($y+1)] = $this->grid[$x][($y+1)];
                }
                // left
                if ($y-1 >= 0) {
                    $grid[$x.'-'.$y][$x.'-'.($y-1)] = $this->grid[$x][($y-1)];
                }
            }
        }

        return $grid;
    }

    private function getGrid($rows): void
    {
        $this->grid = [];
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                break;
            }

            $this->grid[] = str_split($row);
        }
        $this->maxHeight = count($this->grid);
        $this->maxWidth = count($this->grid[0]);
    }
}
