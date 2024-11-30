<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\Dijkstra\Dijkstra;

class Y2023D17Service implements DayServiceInterface
{
    private string $title = "Clumsy Crucible";

    public function getTitle(): string
    {
        return $this->title;
    }

    public function __construct(public array $grid = [], public array $dijkstraGrid = [], public int $maxHeight = 0, public int $maxWidth = 0)
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->getGrid($rows);

        $this->createDijkstraGrid();
//dd($dijkstraGrid);
        $source = '0-0';

        $dijkstra = new Dijkstra($this->dijkstraGrid, $source, true);
//        dump($this->dijkstraGrid);
//        dd($dijkstra);
        $destination    = '12-12';
        $shortest = $dijkstra->shortestPathTo($destination);

        $loop = true;
        while ($loop) {
//            dump($shortest);
            $loop = false;
            if ($this->exceededMaxStraight($shortest)) {
//                dump($this->dijkstraGrid);
                $dijkstra = new Dijkstra($this->dijkstraGrid, $source, true);
                $shortest = $dijkstra->shortestPathTo($destination);
//                dd($shortest);
                $loop = true;
            }

        }

        dd($shortest);
        return '';
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return '0';
    }

    private function exceededMaxStraight(array $path): bool
    {
        $lastPosition = null;
        $direction = null;
        $directionTotal = 0;
        foreach ($path as $pathValue) {
            [$x, $y] = explode('-', $pathValue['node_identifier']);
            if ($lastPosition === null) {
                $lastPosition = $x . '-' . $y;
                continue;
            }

            [$xL, $yL] = explode('-', $lastPosition);
            if ($x === $xL) {
                // collumn is anders -> links of rechts
                if ($y < $yL) {
                    $newDirection = 'L';
                } else {
                    $newDirection = 'R';
                }
                if ($newDirection === $direction) {
                    $directionTotal++;
                } else {
                    $direction = $newDirection;
                    $directionTotal = 0;
                }
            } elseif ($y === $yL) {
                // row is anders -> boven onder
                if ($x < $xL) {
                    $newDirection = 'U';
                } else {
                    $newDirection = 'D';
                }
                if ($newDirection === $direction) {
                    $directionTotal++;
                } else {
                    $direction = $newDirection;
                    $directionTotal = 0;
                }
            }
            if ($directionTotal > 2) {
                // haal de verbinding weg uit de grid
                unset($this->dijkstraGrid[$lastPosition][$x . '-' . $y]);
                return true;
            }

            $lastPosition = $x . '-' . $y;
        }
//        if (!isset($this->previous[$current])) {
//            return false;
//        }
//        [$x, $y] = explode('-', $current);
//        [$xp, $yp] = explode('-', $this->previous[$current]);
//        [$xn, $yn] = explode('-', $neighbour);
//
//        if ($x === $xp && $x === $xn) {
//            if (isset($this->previous[$this->previous[$this->previous[$current]]])) {
//                [$xt, $yt] = explode('-', $this->previous[$this->previous[$this->previous[$current]]]);
//                if ((int)$x === (int)$xt &&  (int)$yt === (int)($y-3)) {
//                    return true;
//                }
//            }
//        }
//        if ($y === $yp && $y === $yn) {
//            if (isset($this->previous[$this->previous[$this->previous[$current]]])) {
//                [$xt, $yt] = explode('-', $this->previous[$this->previous[$this->previous[$current]]]);
//                if ((int)$y === (int)$yt && (int)$xt === (int)($x-3)) {
//                    return true;
//                }
//            }
//        }
//
////        if (
////            ((isset($this->previous[$x . '-' . ($y+1)]) && isset($this->previous[$x . '-' . ($y+2)]) && isset($this->previous[$x . '-' . ($y+3)]))) ||
////            ((isset($this->previous[$x . '-' . ($y-1)]) && isset($this->previous[$x . '-' . ($y-2)]) && isset($this->previous[$x . '-' . ($y-3)]))) ||
////            ((isset($this->previous[($x+1) . '-' . $y]) && isset($this->previous[($x+2) . '-' . $y]) && isset($this->previous[($x+3) . '-' . $y]))) ||
////            ((isset($this->previous[($x-1) . '-' . $y]) && isset($this->previous[($x-2) . '-' . $y]) && isset($this->previous[($x-3) . '-' . $y])))
////        ) {
////            return true;
////        }
        return false;
    }

    private function createDijkstraGrid(): void
    {
        $grid = [];
        for ($x=0;$x<$this->maxHeight;$x++) {
            for ($y=0;$y<$this->maxWidth;$y++) {
                $grid[$x.'-'.$y] = [];
                // right
                if ($y+1 < $this->maxWidth) {
                    $grid[$x.'-'.$y][$x.'-'.($y+1)] = $this->grid[$x][($y+1)];
                }
                // bottom
                if ($x+1 < $this->maxHeight) {
                    $grid[$x.'-'.$y][($x+1).'-'.$y] = $this->grid[($x+1)][$y];
                }
                // top
                if ($x-1 >= 0) {
                    $grid[$x.'-'.$y][($x-1).'-'.$y] = $this->grid[($x-1)][$y];
                }
                // left
                if ($y-1 >= 0) {
                    $grid[$x.'-'.$y][$x.'-'.($y-1)] = $this->grid[$x][($y-1)];
                }
            }
        }
        $this->dijkstraGrid = $grid;
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
