<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\TSP\Map;
use App\Service\Tools\TSP\NearestNeighborSolver;
use App\Service\Tools\TSP\Type;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D13')]
class D13Service implements DayServiceInterface
{
    private int $total = 0;
    private array $happinessGrid = [];

    public function generatePart1(array $rows): string
    {
        $this->generateHappinessMap($rows);
        $happinessMap = new Map($this->happinessGrid);
        $solver = new NearestNeighborSolver();
        $solver->setReturnHome(true);
        $result = $solver->solve(array_keys($this->happinessGrid), $happinessMap, Type::LONGPATH);

        return $result->totalDistance;
    }

    public function generatePart2(array $rows): string
    {
        ini_set("memory_limit", '256M');
        $this->generateHappinessMap($rows);
        $this->addMeToHappinessGrid();
        $happinessMap = new Map($this->happinessGrid);
        $solver = new NearestNeighborSolver();
        $solver->setReturnHome(true);
        $result = $solver->solve(array_keys($this->happinessGrid), $happinessMap, Type::LONGPATH);

        return $result->totalDistance;
    }

    private function addMeToHappinessGrid(): void
    {
        $myNr = count($this->happinessGrid);
        $this->happinessGrid[$myNr] = [];
        for ($i=0; $i <= $myNr; $i++) {
            $this->happinessGrid[$i][$myNr] = 0;
            $this->happinessGrid[$myNr][$i] = 0;
        }
    }

    private function generateHappinessMap(array $rows): void
    {
        $names = [];

        // Verzamel steden en bouw matrix
        foreach ($rows as $line) {
            if (preg_match('/^(\w+) would (gain|lose) (\d+) happiness units by sitting next to (\w+)./', $line, $matches)) {
                [$full, $firstName, $valueType, $value, $secondName] = $matches;

                $value = (int)$value;
                if ($valueType === 'lose') {
                    $value *= -1;
                }

                // Voeg namen toe als ze nog niet bestaan
                if (!array_key_exists($firstName, $names)) {
                    $names[$firstName] = count($names);
                }
                if (!array_key_exists($secondName, $names)) {
                    $names[$secondName] = count($names);
                }

                $i = $names[$firstName];
                $j = $names[$secondName];

                // Init arrays indien nodig
                if (!isset($this->happinessGrid[$i])) $this->happinessGrid[$i] = [];
                if (!isset($this->happinessGrid[$j])) $this->happinessGrid[$j] = [];

                // Vul symmetrische matrix
                $this->happinessGrid[$i][$j] = ($this->happinessGrid[$i][$j] ?? 0) + $value;
                $this->happinessGrid[$j][$i] = ( $this->happinessGrid[$j][$i] ?? 0) + $value;
            }
        }

        // Zorg dat de matrix compleet is (ook met nullen)
        $n = count($names);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if (!isset($this->happinessGrid[$i][$j])) {
                    $this->happinessGrid[$i][$j] = ($i === $j) ? 0 : PHP_INT_MAX; // onbereikbaar = "oneindig"
                }
            }
        }
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^\w+ would (gain|lose) \d+ happiness units by sitting next to \w+.$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}