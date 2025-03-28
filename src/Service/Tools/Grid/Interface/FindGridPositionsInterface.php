<?php

namespace App\Service\Tools\Grid\Interface;

interface FindGridPositionsInterface
{
    public function search(array $grid, string|int $value, bool $findAll = false): array;
}
