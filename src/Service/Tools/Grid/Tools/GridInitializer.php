<?php

namespace App\Service\Tools\Grid\Tools;

use App\Service\Tools\Grid\Interface\GridInitializerInterface;

class GridInitializer implements GridInitializerInterface
{
    /**
     * @param array<string> $rows
     * @return array<array<string|int>>
     */
    public function initialize(array $rows): array
    {
        $grid = [];
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            $grid[] = str_split($row);
        }
        return $grid;
    }
}
