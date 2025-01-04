<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\LCM;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D8')]
class D8Service implements DayServiceInterface
{
    public LCM $LCM;
    public function __construct()
    {
        $this->LCM = new LCM();
    }

    public function generatePart1(array $rows): string
    {
        $start = 'AAA';
        $end = 'ZZZ';

        [$mapData, $mapDirections] = $this->getMapData($rows);

        return (string)$this->findEndPosition($start, $end, $mapDirections, $mapData);
    }

    public function generatePart2(array $rows): string
    {
        [$mapData, $mapDirections] = $this->getMapData($rows);
        return (string)$this->findAllEndPositions($mapDirections, $mapData);
    }

    private function findEndPosition(string $start, string $end, array $mapDirections, array $mapData): int
    {
        $i = 0;
        $found = false;
        $currentPosition = $start;

        while (!$found) {
            if ($currentPosition === $end) {
                break;
            }
            foreach ($mapDirections as $direction) {
                $i++;
                $currentPosition = $mapData[$currentPosition][$direction];
            }
        }

        return $i;
    }

    private function getMapData($rows): array
    {
        $mapData = [];
        $mapDirections = [];
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }

            if (empty($mapDirections)) {
                $mapDirections = str_split($row);
                continue;
            }
            [$mapName, $directions] = explode(' = ', $row);
            $mapData[$mapName] = array_combine(['L', 'R'], explode(', ', str_replace(['(', ')'], '',$directions)));
        }

        return [$mapData,$mapDirections];
    }

    private function findAllEndPositions(array $mapDirections, array $mapData): int
    {
        $startPositions = $this->findStartPositions($mapData);
        $currentPositions = $startPositions;
        $result = [];
        foreach ($currentPositions as $position) {
            $i = 0;
            $currentPosition = $position;
            $found = false;
            while (!$found) {
                foreach ($mapDirections as $direction) {
                    if ($this->allPositionsHasEnded([$currentPosition])) {
                        $found = true;
                        $result[] = $i;
                        break;
                    }
                    $i++;
                    $currentPosition = $mapData[$currentPosition][$direction];
                }
            }
        }

        return $this->LCM->lcmofn($result, count($result));
    }

    private function findStartPositions(array $mapData): array
    {
        $startPositions = [];
        foreach (array_keys($mapData) as $mapPosition) {
            if (str_ends_with($mapPosition, 'A')) {
                $startPositions[] = $mapPosition;
            }
        }

        return $startPositions;
    }

    private function allPositionsHasEnded(array $currentPositions): bool
    {
        foreach ($currentPositions as $mapPosition) {
            if (!str_ends_with($mapPosition, 'Z')) {
                return false;
            }
        }

        return true;
    }
}
