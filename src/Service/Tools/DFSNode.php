<?php

declare(strict_types=1);

namespace App\Service\Tools;

class DFSNode
{
    public function __construct(public string $name = '', public array $linked = [])
    {
    }

    public function linkTo(DFSNode $node, $also = true)
    {
        if (!$this->linked($node)) {
            $this->linked[] = $node;
        }
        if ($also) {
            $node->linkTo($this, false);
        }

        return $this;
    }

    private function linked(DFSNode $node): bool
    {
        foreach ($this->linked as $l) {
            if ($l->name === $node->name) {
                return true;
            }
        }

        return false;
    }

    public function notVisitedNodes(array $visitedNames)
    {
        $ret = [];
        foreach ($this->linked as $l) {
            if (!in_array($l->name, $visitedNames, true)) {
                $ret[] = $l;
            }
        }

        return $ret;
    }
}