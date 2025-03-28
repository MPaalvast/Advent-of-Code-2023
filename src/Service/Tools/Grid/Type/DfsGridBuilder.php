<?php

namespace App\Service\Tools\Grid\Type;

use App\Service\Tools\Grid\DFSAlgorithm;
use App\Service\Tools\Grid\Dto\DfsDto;
use App\Service\Tools\Grid\GridManager;
use App\Service\Tools\Grid\NodeManager;
use App\Service\Tools\Grid\Tools\FindGridPositions;
use App\Service\Tools\Grid\Tools\GridInitializer;

class DfsGridBuilder
{
    private array $rows;

    public function __construct(
        private readonly GridInitializer $gridInitializer,
        private readonly FindGridPositions $findGridPositions
    ) {
    }

    /**
     * Stel de grid-rijen in voor de DFS Grid Builder.
     *
     * @param array $rows De rijen die de grid definiëren.
     */
    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }

    /**
     * Maak een nieuwe DfsDto instantie gebaseerd op de ingestelde grid.
     *
     * @return DfsDto Geeft de gemaakte Data Transfer Object terug.
     */
    public function create(): DfsDto
    {
        $nodeManager = new NodeManager();
        return new DfsDto(
            new GridManager($this->rows, $this->gridInitializer),
            $nodeManager,
            new DFSAlgorithm($nodeManager),
            $this->findGridPositions
        );
    }
}
