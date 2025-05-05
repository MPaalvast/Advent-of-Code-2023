<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\TSP\Map;
use App\Service\Tools\TSP\NearestNeighborSolver;
use App\Service\Tools\TSP\Type;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D9')]
class D9Service implements DayServiceInterface
{
    private int $total = 0;
    private array $distances = [];

    public function generatePart1(array $rows): string
    {
        $this->generateDistanceMap($rows);
        $cityMap = new Map($this->distances);
        $solver = new NearestNeighborSolver();
        $result = $solver->solve(array_keys($this->distances), $cityMap);

        return $result->totalDistance;
    }

    public function generatePart2(array $rows): string
    {
        $this->generateDistanceMap($rows);
        $cityMap = new Map($this->distances);
        $solver = new NearestNeighborSolver();
        $result = $solver->solve(array_keys($this->distances), $cityMap, Type::LONGPATH);

        return $result->totalDistance;
    }

    private function generateDistanceMap(array $rows): void
    {
        $cities = [];

        // Verzamel steden en bouw matrix
        foreach ($rows as $line) {
            if (preg_match('/(\w+) to (\w+) = (\d+)/', $line, $matches)) {
                [$full, $from, $to, $distance] = $matches;

                // Voeg steden toe als ze nog niet bestaan
                if (!array_key_exists($from, $cities)) {
                    $cities[$from] = count($cities);
                }
                if (!array_key_exists($to, $cities)) {
                    $cities[$to] = count($cities);
                }

                $i = $cities[$from];
                $j = $cities[$to];
                $dist = (int)$distance;

                // Init arrays indien nodig
                if (!isset($this->distances[$i])) $this->distances[$i] = [];
                if (!isset($this->distances[$j])) $this->distances[$j] = [];

                // Vul symmetrische matrix
                $this->distances[$i][$j] = $dist;
                $this->distances[$j][$i] = $dist;
            }
        }

        // Zorg dat de matrix compleet is (ook met nullen)
        $n = count($cities);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if (!isset($this->distances[$i][$j])) {
                    $this->distances[$i][$j] = ($i === $j) ? 0 : PHP_INT_MAX; // onbereikbaar = "oneindig"
                }
            }
        }
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^([A-Za-z]+) to ([A-Za-z]+) = (\d+)$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}