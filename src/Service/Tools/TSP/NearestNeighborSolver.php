<?php

namespace App\Service\Tools\TSP;

class NearestNeighborSolver implements TspSolverInterface
{
    private bool $returnHome = false;
    public function solve(array $cities, Map $map, Type $type = TYPE::SHORTPATH): TspResult {
        $routes = $this->generatePermutations($cities);

        $shortestDistance = $type === TYPE::SHORTPATH ? PHP_INT_MAX : 0;
        $shortestRoute = [];

        foreach ($routes as $route) {
            $currentDistance = $this->calculateRouteDistance($route, $map);
            if (
                ($type === TYPE::SHORTPATH && $currentDistance < $shortestDistance) ||
                ($type ===Type::LONGPATH && $currentDistance > $shortestDistance)
            ) {
                $shortestDistance = $currentDistance;
                $shortestRoute = $route;
            }
        }

        return new TspResult($shortestRoute, $shortestDistance);
    }

    // Genereer alle permutaties van een array
    private function generatePermutations(array $items, array $permutation = []): array
    {
        if (empty($items)) {
            return [$permutation];
        }

        $result = [];
        foreach ($items as $key => $item) {
            $remainingItems = $items;
            unset($remainingItems[$key]);
            $result = array_merge($result, $this->generatePermutations($remainingItems, array_merge($permutation, [$item])));
        }

        return $result;
    }

// Bereken totale afstand van een route
    private function calculateRouteDistance(array $route, Map $map): int
    {
        $distance = 0;
        $cityCount = count($route);

        for ($i = 0; $i < $cityCount - 1; $i++) {
            $distance += $map->getDistance($route[$i], $route[$i + 1]);
        }

        if ($this->returnHome) {
            // Terug naar de beginstad
            $distance += $map->getDistance($route[$cityCount - 1], $route[0]);
        }

        return $distance;
    }

    public function setReturnHome(bool $returnHome): self
    {
        $this->returnHome = $returnHome;
        return $this;
    }
}