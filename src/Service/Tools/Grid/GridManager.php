<?php

namespace App\Service\Tools\Grid;

use App\Service\Tools\Grid\Tools\GridInitializer;

class GridManager
{
    private array $grid;

    /**
     * @param array<string> $rows
     */
    public function __construct(
        array $rows,
        private readonly GridInitializer $gridInitializer,
    )
    {
        $this->grid = $this->gridInitializer->initialize($rows);
    }

    public function getGrid(): array
    {
        return $this->grid;
    }
}
