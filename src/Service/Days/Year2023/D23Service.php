<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\DFSNode;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D23')]
class D23Service implements DayServiceInterface
{
    public function __construct(public array $grid = [], public array $gridNodes = [])
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->createGrid($rows);
        $this->createNodes();
        $this->dfs($this->gridNodes['0-1']);
        return '0';
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return '0';
    }

    private function createGrid(array|\Generator $rows): void
    {
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if ('' === $row) {
                continue;
            }

            $this->grid[] = str_split($row);
        }
    }

    private function createNodes(): void
    {
        foreach ($this->grid as $x => $row) {
            foreach ($row as $y => $value) {
                if (in_array($value, ['<', '>', '^', 'v', '.'])) {
                    $this->addToNodes($x, $y, $value);
                }
            }
        }
    }

    private function addToNodes(int $x, int $y, string $value)
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
        if (isset($this->grid[$x-1][$y]) && in_array($value, ['.', '^']) && in_array($this->grid[$x-1][$y], ['.', '<', '>', '^'])) {
            if (!isset($this->gridNodes[$nodeUpId])) {
                $this->gridNodes[$nodeUpId] = new DFSNode($nodeUpId);
            }
            $also = !($value === '^');
            $this->gridNodes[$nodeId]->linkTo($this->gridNodes[$nodeUpId], $also);
        }
        // down
        if (isset($this->grid[$x+1][$y]) && in_array($value, ['.', 'v']) && in_array($this->grid[$x+1][$y], ['.', '<', '>', 'v'])) {
            if (!isset($this->gridNodes[$nodeDownId])) {
                $this->gridNodes[$nodeDownId] = new DFSNode($nodeDownId);
            }
            $also = !($value === 'v');
            $this->gridNodes[$nodeId]->linkTo($this->gridNodes[$nodeDownId], $also);
        }
        // left
        if (isset($this->grid[$x][$y-1]) && in_array($value, ['.', '<']) && in_array($this->grid[$x][$y-1], ['.', '<', 'v', '^'])) {
            if (!isset($this->gridNodes[$nodeLeftId])) {
                $this->gridNodes[$nodeLeftId] = new DFSNode($nodeLeftId);
            }
            $also = !($value === '<');
            $this->gridNodes[$nodeId]->linkTo($this->gridNodes[$nodeLeftId], $also);
        }
        // right
        if (isset($this->grid[$x][$y+1]) && in_array($value, ['.', '>']) && in_array($this->grid[$x][$y+1], ['.', 'v', '>', '^'])) {
            if (!isset($this->gridNodes[$nodeRightId])) {
                $this->gridNodes[$nodeRightId] = new DFSNode($nodeRightId);
            }
            $also = !($value === '>');
            $this->gridNodes[$nodeId]->linkTo($this->gridNodes[$nodeRightId], $also);
        }
    }

    private function dfs(DFSNode $node, string $path = '', array $visited = array()): void
    {
        $visited[] = $node->name;
        $not_visited = $node->notVisitedNodes($visited);
        if (empty($not_visited)) {
            dump('path : ' . $path . '->' . $node->name);
            dump(explode('->', $path));
            return;
        }
        foreach ($not_visited as $n) {
            $this->dfs($n, $path . '->' . $node->name, $visited);
        }
    }

//    /* Building Graph */
//$root = new Node('root');
//foreach (range(1, 6) as $v) {
//$name = "node{$v}";
//$$name = new Node($name);
//}
//$root->link_to($node1)->link_to($node2);
//$node1->link_to($node3)->link_to($node4);
//$node2->link_to($node5)->link_to($node6);
//$node4->link_to($node5);
//
//
///* Searching Path */
//function dfs(Node $node, $path = '', $visited = array())
//{
//    $visited[] = $node->name;
//    $not_visited = $node->not_visited_nodes($visited);
//    if (empty($not_visited)) {
//        echo 'path : ' . $path . '->' . $node->name . PHP_EOL;
//        return;
//    }
//    foreach ($not_visited as $n) dfs($n, $path . '->' . $node->name, $visited);
//}
//
//dfs($root);
//// path : ->root->node1->node3
//// path : ->root->node1->node4->node5->node2->node6
//// path : ->root->node2->node5->node4->node1->node3
//// path : ->root->node2->node6
}
