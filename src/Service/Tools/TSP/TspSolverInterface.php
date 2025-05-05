<?php

namespace App\Service\Tools\TSP;

interface TspSolverInterface
{
    public function solve(array $cities, Map $map, Type $type): TspResult;
}