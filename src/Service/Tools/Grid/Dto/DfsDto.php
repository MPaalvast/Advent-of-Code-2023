<?php

namespace App\Service\Tools\Grid\Dto;

use App\Service\Tools\Grid\DFSAlgorithm;
use App\Service\Tools\Grid\GridManager;
use App\Service\Tools\Grid\NodeManager;
use App\Service\Tools\Grid\Tools\FindGridPositions;

class DfsDto
{
    private GridManager $gridManager;
    private NodeManager $nodeManager;
    private DFSAlgorithm $dfsAlgorithm;
    private FindGridPositions $findGridPositions;
    private array $grid;
    private int $totalPaths = 0;

    public function __construct(
        GridManager $gridManager,
        NodeManager $nodeManager,
        DFSAlgorithm $dfsAlgorithm,
        FindGridPositions $findGridPositions
    )
    {
        $this->gridManager = $gridManager;
        $this->nodeManager = $nodeManager;
        $this->dfsAlgorithm = $dfsAlgorithm;
        $this->findGridPositions = $findGridPositions;

        $this->grid = $this->gridManager->getGrid();
        $this->initializeNodes();
    }

    public function initializeNodes(): void
    {
        foreach ($this->grid as $x => $row) {
            foreach ($row as $y => $value) {
                $nodeId = $x . '-' . $y;
                $this->nodeManager->createNode($nodeId);
                $this->linkAdjacentNodes($x, $y, (int)$value);
            }
        }
    }

    private function linkAdjacentNodes(int $x, int $y, int $value): void
    {
        $nodeId = $x . '-' . $y;
        $nextValue = $value + 1;

        // Links naar aangrenzende nodes
        $this->tryLinkNode($nodeId, $x - 1, $y, $nextValue); // up
        $this->tryLinkNode($nodeId, $x + 1, $y, $nextValue); // down
        $this->tryLinkNode($nodeId, $x, $y - 1, $nextValue); // left
        $this->tryLinkNode($nodeId, $x, $y + 1, $nextValue); // right
    }

    private function tryLinkNode(string $nodeId, int $x, int $y, int $value): void
    {
        if (isset($this->grid[$x][$y]) && (int)$this->grid[$x][$y] === $value) {
            $targetNodeId = $x . '-' . $y;
            $this->nodeManager->createNode($targetNodeId);
            $this->nodeManager->linkNodes($nodeId, $targetNodeId);
        }
    }

    public function findPaths(array $startPositions = [], array $endPositions = []): int
    {
        foreach ($startPositions as $start) {
            $startNodeId = $start['x'] . '-' . $start['y'];
            foreach ($endPositions as $end) {
                $endNodeId = $end['x'] . '-' . $end['y'];
                $startNode = $this->nodeManager->getNode($startNodeId);
                if ($startNode && $this->dfsAlgorithm->dfs($startNode, $endNodeId)) {
                    $this->totalPaths++;
                }
            }
        }

        return $this->totalPaths;
    }

    public function findAllPaths(array $startPositions = [], array $endPositions = []): int
    {
        foreach ($startPositions as $start) {
            $startNodeId = $start['x'] . '-' . $start['y'];
            foreach ($endPositions as $end) {
                $endNodeId = $end['x'] . '-' . $end['y'];
                $totalPaths = 0;
                $startNode = $this->nodeManager->getNode($startNodeId);
                if ($startNode && $this->dfsAlgorithm->dfsAll($startNode, $endNodeId, $totalPaths)) {
                    $this->totalPaths += $totalPaths;
                }
            }
        }

        return $this->totalPaths;
    }

    public function getStartPosition(string|int $value, bool $findAll = false): array
    {
        return $this->findPosition($value, $findAll);
    }
    public function getEndPosition(string|int $value, bool $findAll = false): array
    {
        return $this->findPosition($value, $findAll);
    }

    public function findPosition(string|int $value, bool $findAll = false): array
    {
        return $this->findGridPositions->search($this->gridManager->getGrid(), $value, $findAll);
    }

}
