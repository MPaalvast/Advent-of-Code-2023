<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\Dijkstra\DijkstraWithTurnPenalty;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D16')]
class D16Service implements DayServiceInterface
{
    private string $title = "Reindeer Maze";
    private int $total = 0;
    private string $startPoint = '';
    private string $endPoint = '';
    private array $grid = [];
    private array $dijkstraGrid = [];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->generateGrid($rows);
        $this->generateDijkstraInput();
        $dijkstra = new DijkstraWithTurnPenalty($this->dijkstraGrid, $this->startPoint, 1000, true);
        $shortest_path1 = $dijkstra->shortestPathTo($this->endPoint);

        $this->calculateTotal($shortest_path1);

        dump($shortest_path1);
        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return $this->total;
    }

    private function generateGrid(array|\Generator  $rows): void
    {
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $gridRow = str_split($row);

            foreach ($gridRow as $y => $rowYValue) {
                if ($rowYValue === 'S') {
                    $this->startPoint = $x . '-' . $y;
                } elseif ($rowYValue === 'E') {
                    $this->endPoint = $x . '-' . $y;
                }
            }
            $this->grid[] = $gridRow;
        }
    }

    private function generateDijkstraInput(): void
    {
        foreach ($this->grid as $x => $row) {
            foreach ($row as $y => $value) {
                $index = $x . '-' . $y;
                $options = ['.', 'S', 'E'];
                if (in_array($value, $options, true)) {
                    $this->dijkstraGrid[$index] = [];
                    $indexLeft = $x . '-' . $y-1;
                    $indexRight = $x . '-' . $y+1;
                    $indexUp = $x-1 . '-' . $y;
                    $indexDown = $x+1 . '-' . $y;
                    $this->setDijkstraGridField($indexLeft, $options, $index);
                    $this->setDijkstraGridField($indexRight, $options, $index);
                    $this->setDijkstraGridField($indexUp, $options, $index);
                    $this->setDijkstraGridField($indexDown, $options, $index);
                }
            }
        }
    }

    /**
     * @param string $indexLeft
     * @param array $options
     * @param string $index
     * @param string $indexRight
     * @return void
     */
    private function setDijkstraGridField(string $indexTo, array $options, string $index): void
    {
        [$x, $y] = array_map('intval', explode('-', $indexTo));
        if (isset($this->grid[$x][$y]) && in_array($this->grid[$x][$y], $options, true)) {
            $this->dijkstraGrid[$index][$indexTo] = 1;
        }
    }

    private function calculateTotal(array $shortest_path1): void
    {
        $costs = 0;
        if (!empty($shortest_path1)) {
            $costs = $shortest_path1[count($shortest_path1)-1]['accumulated_weight'];
        }
        $this->total = $costs;
    }
}
// 136592 => to high