<?php

namespace App\Service\Tools\Grid;

use App\Service\Tools\DFSNode;

class DFSAlgorithm
{
    public function dfs(DFSNode $node, string $endNodeId, array $visited = []): bool
    {
        $visited[] = $node->name;

        if ($node->name === $endNodeId) {
            return true;
        }

        $notVisitedNodes = $node->notVisitedNodes($visited);
        if (empty($notVisitedNodes)) {
            return false;
        }

        foreach ($notVisitedNodes as $nextNode) {
            if ($this->dfs($nextNode, $endNodeId, $visited)) {
                return true;
            }
        }

        return false;
    }

    public function dfsAll(DFSNode $node, string $endNodeId, int &$totalPaths = 0, array $visited = []): bool
    {
        $visited[] = $node->name;

        if ($node->name === $endNodeId) {
            $totalPaths++;
            return false;
        }

        $notVisitedNodes = $node->notVisitedNodes($visited);
        foreach ($notVisitedNodes as $nextNode) {
            $this->dfsAll($nextNode, $endNodeId, $totalPaths, $visited);
        }

        return true;
    }

}
