<?php

namespace App\Service\Tools\TSP;

class Map
{
    private array $distances;

    public function __construct(array $distances) {
        $this->distances = $distances;
    }

    public function getDistance(int $from, int $to): int {
        return $this->distances[$from][$to];
    }

    public function size(): int {
        return count($this->distances);
    }
}