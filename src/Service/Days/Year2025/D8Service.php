<?php

namespace App\Service\Days\Year2025;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2025D8')]
class D8Service implements DayServiceInterface
{
    private array $connectionsArray = [];
    private array $pathLengthArray = [];
    private array $lastConnectionIds  = [];
    private int $connectionsToMake = 1000;
    private int $total = 1;
    public function generatePart1(array $rows): string
    {
        $this->setInput($rows);
        if ($rows[0] === '162,817,812') {
            $this->connectionsToMake = 10;
        }

        $this->makeConnections();
        $this->orderConnections();
        dump($this->connectionsArray);
        $this->calcutaleTotal();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->setInput($rows);
        $this->connectionsToMake = 10000;

        $this->makeConnections();
        $this->orderConnections();
        dump($this->connectionsArray);
        $this->calcutaleConnectionTotal();

        return $this->total;
    }

    private function calcutaleConnectionTotal(): void
    {
        foreach ($this->lastConnectionIds as $connectionId) {
//            dump($connectionId);
            $this->total *= strstr($connectionId, ',', true);
        }
    }

    private function calcutaleTotal(): void
    {
        $results = array_slice($this->connectionsArray, 0, 3);
        foreach ($results as $result) {
            $this->total *= count($result);
        }
    }

    private function orderConnections(): void
    {
        uasort($this->connectionsArray, static function ($a, $b) {
            $a = count($a);
            $b = count($b);
            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? 1 : -1;
        });
    }

    private function makeConnections(): void
    {
        $pathLengthArrayKeys = array_keys($this->pathLengthArray);
        for ($i=0; $i < $this->connectionsToMake; $i++) {
            [$key1, $key2] = explode('-', array_shift($pathLengthArrayKeys));
            $id1 = $this->findLocationKey($key1);
            $id2 = $this->findLocationKey($key2);
            if ($id1 === $id2) {
                continue;
            }

            $this->connectionsArray[$id1] = array_merge(array_values($this->connectionsArray[$id1]), array_values($this->connectionsArray[$id2]));
            unset($this->connectionsArray[$id2]);

            if (count($this->connectionsArray) === 1) {
                $this->lastConnectionIds = [$key1, $key2];
                dump($key1, $key2);
                break;
            }
        }

    }

    private function findLocationKey(string $keyToFind): int
    {
        foreach ($this->connectionsArray as $key => $connections) {
            if (in_array($keyToFind, $connections)) {
                return $key;
            }
        }
        return -1;
    }

    private function setInput(array $rows): void
    {
        while (!empty($rows)) {
            $row = array_shift($rows);
            $this->connectionsArray[] = [$row];
            if (empty($rows)) {
                break;
            }
            [$rowX, $rowY, $rowZ] = explode(',', $row);
            foreach ($rows as $rowEndpoint) {
                [$rowEndX, $rowEndY, $rowEndZ] = explode(',', $rowEndpoint);
                $this->pathLengthArray[$row . '-' . $rowEndpoint] = $this->calculate3DDistance(['x' => $rowX, 'y' => $rowY, 'z' => $rowZ], ['x' => $rowEndX, 'y' => $rowEndY, 'z' => $rowEndZ]);
            }
        }
        asort($this->pathLengthArray);
    }

    private function calculate3DDistance($p1, $p2) {
        return sqrt(
            ($p2['x']- $p1['x']) ** 2 +
            ($p2['y'] - $p1['y']) ** 2 +
            ($p2['z'] - $p1['z']) ** 2
        );
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^\d+,\d+,\d+$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}