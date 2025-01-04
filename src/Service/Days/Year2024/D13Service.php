<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D13')]
class D13Service implements DayServiceInterface
{
    private int $total = 0;
    private array $results = [];
    private array $buttonValue = [];
    private int $maxASteps = 0;
    private array $gameData = [];

    public function generatePart1(array|\Generator $rows): string
    {
        $this->maxASteps = 100;
        $this->buttonValue['A'] = 3;
        $this->buttonValue['B'] = 1;
        $this->readData($rows);
        $this->calculateResults();
        $this->getTotal();

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        // LCM ????
        return $this->total;
    }

    private function readData(array|\Generator $rows): void
    {
        $i = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                $i++;
                continue;
            }
            if (!isset($this->gameData[$i])) {
                $this->gameData[$i] = [];
            }
            $parts = explode(': ', $row);
            if ($parts[0] !== 'Prize') {
                $titleParts = explode(' ', $parts[0]);
                $title = $titleParts[1];
            } else {
                $title = $parts[0];
            }

            $this->gameData[$i][$title] = $this->getGameData($title, $parts[1]);
        }
    }

    private function getGameData(string $title, string $data, string $separator = '+'): array
    {
        if ($title === 'Prize') {
            $separator = '=';
        }
        $parts = explode(', ', $data);
        $result = [];
        foreach ($parts as $part) {
            $part = explode($separator, $part);
            $result[$part[0]] = $part[1];
        }

        return $result;
    }

    private function calculateResults(): void
    {
        foreach ($this->gameData as $game) {
            $maxASteps = max(floor($game['Prize']['X']/$game['A']['X']),floor($game['Prize']['Y']/$game['A']['Y']));

            if ($maxASteps > $this->maxASteps) {
                $maxASteps = $this->maxASteps;
            }
            $bestSolution = null;

            for ($i=$maxASteps; $i > 0; $i--) {
                $remainderX = $game['Prize']['X'] - ($game['A']['X']*$i);
                $remainderY = $game['Prize']['Y'] - ($game['A']['Y']*$i);
                if (($remainderX === 0 || ($remainderX % $game['B']['X']) === 0) && ($remainderY === 0 || ($remainderY % $game['B']['Y']) === 0)) {

                    $iB = $remainderX / $game['B']['X'];
                    $iBY = $remainderY / $game['B']['Y'];
                    if (($iB > $this->maxASteps || $iBY > $this->maxASteps) || $iB !== $iBY) {
                        continue;
                    }
                    $result = ($i * $this->buttonValue['A']) + ($iB * $this->buttonValue['B']);
                    if ($bestSolution === null || $result < $bestSolution) {
                        $bestSolution = $result;
                    }

                }
            }
            $this->results[] = $bestSolution;
        }
    }

    private function getTotal(): void
    {
        $this->total = array_sum($this->results);
    }
}
