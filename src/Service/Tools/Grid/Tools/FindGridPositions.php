<?php

namespace App\Service\Tools\Grid\Tools;

use App\Service\Tools\Grid\Interface\FindGridPositionsInterface;

class FindGridPositions implements FindGridPositionsInterface
{
    public function search(array $grid, string|int $value, bool $findAll = false): array
    {
        $positions = [];
        foreach ($grid as $x => $row) {
            foreach ($row as $y => $cell) {
                if ($cell == $value) {
                    $positions[] = ['x' => $x, 'y' => $y];
                }
                if (!empty($positions) && !$findAll) {
                    return $positions;
                }
            }
        }

        return $positions;
    }
}
