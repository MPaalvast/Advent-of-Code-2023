<?php

namespace App\Service\Tools\Grid\Interface;

interface GridInitializerInterface
{
    public function initialize(array $rows): array;
}
