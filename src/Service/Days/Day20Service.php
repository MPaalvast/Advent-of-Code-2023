<?php

declare(strict_types=1);

namespace App\Service\Days;

class Day20Service implements DayServiceInterface
{
    public function __construct(public array $actionList = [], public array $pulses = [])
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->getInputData($rows);
        dd($this->actionList);
        return '0';
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return '0';
    }

    private function getInputData(array|\Generator$rows): void
    {
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if ('' === $row) {
                continue;
            }

            if ($row[0] === '%') {
                $actionId = 'f';
                [$key, $data] = explode(' -> ', substr($row, 1));
                $nextSteps = explode(', ', $data);
            } elseif ($row[0] === '&') {
                $actionId = 'c';
                [$key, $data] = explode(' -> ', substr($row, 1));
                $steps = explode(', ', $data);
                $nextSteps = [];
                foreach ($steps as $step) {
                    $nextSteps[$step] = 'low';
                }
            } else {
                $actionId = 'b';
                [$key, $data] = explode(' -> ', $row);
                $nextSteps = explode(', ', $data);
            }

            $this->actionList[$actionId][$key] = $nextSteps;
        }
    }
}

// flip-flop -> lowPuls -> toggle on/off (highPulse/LowPulse)
// Conjunction
