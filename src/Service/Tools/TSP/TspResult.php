<?php

namespace App\Service\Tools\TSP;

class TspResult
{
    public array $path;
    public int $totalDistance;

    public function __construct(array $path, int $totalDistance) {
        $this->path = $path;
        $this->totalDistance = $totalDistance;
    }

    public function printResult(): void {
        echo "Route: " . implode(" → ", $this->path) . PHP_EOL;
        echo "Totale afstand: " . $this->totalDistance . PHP_EOL;
    }
}