<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\DFSNode;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D10')]
class D10Service implements DayServiceInterface
{
    private int $total = 0;
    private int $dfsAllTotal = 0;
    private array $grid = [];
    private array $gridNodes = [];
    private array $startPoints = [];
    private array $endPoints = [];
    private string $dfsEndPointName = '';

    public function generatePart1(array|\Generator $rows): string
    {
        $this->generateGrid($rows);
        $this->createNodes();
        $this->findPaths();

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $this->generateGrid($rows);
        $this->createNodes();
        $this->findAllPaths();

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
                if ($rowYValue === '0') {
                    $this->startPoints[] = ['x' => $x, 'y' => $y];
                } elseif ($rowYValue === '9') {
                    $this->endPoints[] = ['x' => $x, 'y' => $y];
                }
            }
            $this->grid[] = $gridRow;
        }
    }

    private function createNodes(): void
    {
        foreach ($this->grid as $x => $row) {
            foreach ($row as $y => $value) {
                $this->addToNodes($x, $y, (int)$value);
            }
        }
    }

    private function addToNodes(int $x, int $y, int $value)
    {
        $nodeId = $x . '-' . $y;
        $nodeUpId = ($x-1) . '-' . $y;
        $nodeDownId = ($x+1) . '-' . $y;
        $nodeLeftId = $x . '-' . ($y-1);
        $nodeRightId = $x . '-' . ($y+1);
        if (!isset($this->gridNodes[$nodeId])) {
            $this->gridNodes[$nodeId] = new DFSNode($nodeId);
        }
        // up
        if (isset($this->grid[$x-1][$y]) && (int)$this->grid[$x - 1][$y] === $value + 1) {
            if (!isset($this->gridNodes[$nodeUpId])) {
                $this->gridNodes[$nodeUpId] = new DFSNode($nodeUpId);
            }
            $this->gridNodes[$nodeId]->linkTo($this->gridNodes[$nodeUpId], false);
        }
        // down
        if (isset($this->grid[$x+1][$y]) && (int)$this->grid[$x + 1][$y] === $value + 1) {
            if (!isset($this->gridNodes[$nodeDownId])) {
                $this->gridNodes[$nodeDownId] = new DFSNode($nodeDownId);
            }
            $this->gridNodes[$nodeId]->linkTo($this->gridNodes[$nodeDownId], false);
        }
        // left
        if (isset($this->grid[$x][$y-1]) && (int)$this->grid[$x][$y - 1] === $value + 1) {
            if (!isset($this->gridNodes[$nodeLeftId])) {
                $this->gridNodes[$nodeLeftId] = new DFSNode($nodeLeftId);
            }
            $this->gridNodes[$nodeId]->linkTo($this->gridNodes[$nodeLeftId], false);
        }
        // right
        if (isset($this->grid[$x][$y+1]) && (int)$this->grid[$x][$y + 1] === $value + 1) {
            if (!isset($this->gridNodes[$nodeRightId])) {
                $this->gridNodes[$nodeRightId] = new DFSNode($nodeRightId);
            }
            $this->gridNodes[$nodeId]->linkTo($this->gridNodes[$nodeRightId], false);
        }
    }

    private function findPaths(): void
    {
        foreach ($this->startPoints as $startPoint) {
            foreach ($this->endPoints as $endPoint) {
                $this->dfsEndPointName = $endPoint['x'] . '-' . $endPoint['y'];
                if ($this->dfs($this->gridNodes[$startPoint['x'] . '-' . $startPoint['y']])) {
                    $this->total++;
                }
            }
        }
    }

    private function findAllPaths(): void
    {
        foreach ($this->startPoints as $startPoint) {
            foreach ($this->endPoints as $endPoint) {
                $this->dfsEndPointName = $endPoint['x'] . '-' . $endPoint['y'];
                $this->dfsAllTotal = 0;
                $this->dfsAll($this->gridNodes[$startPoint['x'] . '-' . $startPoint['y']]);
                $this->total += $this->dfsAllTotal;
            }
        }
    }

    private function dfs(DFSNode $node, string $path = '', array $visited = []): bool
    {
        $visited[] = $node->name;

        if ($node->name === $this->dfsEndPointName) {
            return true;
        }

        $not_visited = $node->notVisitedNodes($visited);
        if (empty($not_visited)) {
            return false;
        }
        foreach ($not_visited as $n) {
            $isFound = $this->dfs($n, $path . '->' . $node->name, $visited);
            if ($isFound) {
                return true;
            }
        }
        return false;
    }

    private function dfsAll(DFSNode $node, string $path = '', array $visited = []): void
    {
        $visited[] = $node->name;

        if ($node->name === $this->dfsEndPointName) {
            $this->dfsAllTotal++;
            return;
        }

        $not_visited = $node->notVisitedNodes($visited);
        if (empty($not_visited)) {
            return;
        }
        foreach ($not_visited as $n) {
            $this->dfsAll($n, $path . '->' . $node->name, $visited);
        }
    }
}