<?php

namespace App\Service\Tools\Grid;

use App\Service\Tools\DFSNode;

class NodeManager
{
    private array $nodes = [];

    public function createNode(string $nodeId): DFSNode
    {
        if (!isset($this->nodes[$nodeId])) {
            $this->nodes[$nodeId] = new DFSNode($nodeId);
        }
        return $this->nodes[$nodeId];
    }

    public function getNode(string $nodeId): ?DFSNode
    {
        return $this->nodes[$nodeId] ?? null;
    }

    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function linkNodes(string $sourceNodeId, string $targetNodeId): void
    {
        if (isset($this->nodes[$sourceNodeId]) && isset($this->nodes[$targetNodeId])) {
            $this->nodes[$sourceNodeId]->linkTo($this->nodes[$targetNodeId], false);
        }
    }

}
