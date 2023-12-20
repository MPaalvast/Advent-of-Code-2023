<?php

declare(strict_types=1);

namespace App\Service\Days;

class Day20Service implements DayServiceInterface
{
    public function __construct(public array $actionList = [], public array $pulses = ['low' => 0, 'high' => 0], public bool $machineTurnedOn = false)
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->getInputData($rows);
        for ($i=1;$i<=1000;$i++) {
            $this->pressButton();
        }
        dump($this->pulses);
//        dd($this->actionList);
        return (string)($this->pulses['low']*$this->pulses['high']);
    }

    public function generatePart2(array|\Generator $rows): string
    {
        set_time_limit(1600);
        $this->getInputData($rows);
        for ($i=1;$i<=1000;$i++) {
            $this->pressButton();
        }
        $i = 0;
        while (!$this->machineTurnedOn) {
            $i++;
            $this->pressButton();
        }
//        dd($i);
//        dd($this->actionList);
        return (string)($i);
    }

    private function getInputData(array|\Generator $rows): void
    {
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if ('' === $row) {
                continue;
            }

            if ($row[0] === '%') {
                $actionId = 'f';
                [$key, $data] = explode(' -> ', substr($row, 1));
                $nextSteps = [
                    'steps' => explode(', ', $data),
                    'status' => 'off'
                ];
            } elseif ($row[0] === '&') {
                $actionId = 'c';
                [$key, $data] = explode(' -> ', substr($row, 1));
                $steps = explode(', ', $data);
                $nextSteps = ['steps' => $steps];
            } else {
                $actionId = 'b';
                [$key, $data] = explode(' -> ', $row);
                $nextSteps = explode(', ', $data);
            }

            $this->actionList[$actionId][$key] = $nextSteps;
        }

        // loop door de con heen om de gelinkte flip-flops te vinden
        // als het een con is haal de flipflops van die con ook op
        foreach (array_keys($this->actionList['c']) as $con) {
            $linkedFields = $this->getLinkedConFlipFlops($con);
            $this->actionList['c'][$con]['input'] = $linkedFields;
        }
    }

    private function getLinkedConFlipFlops(string $con): array
    {
        $linkedFields = [];
        foreach ($this->actionList['f'] as $key => $data) {
            if (in_array($con, $data['steps'], true)) {
                $linkedFields[$key] = 'low';
            }
        }
        foreach ($this->actionList['c'] as $key => $data) {
            if (in_array($con, $data['steps'], true)) {
                $linkedFields[$key] = 'low';
            }
        }

        return $linkedFields;
    }

    private function pressButton(bool $exitWhenTurnedOn = false): void
    {
        $inputArray = [];
        $this->pulses['low']++;
        foreach ($this->actionList['b']['broadcaster'] as $node) {
            $inputArray[] = ['id' => $node, 'pulse' => 'low', 'from' => 'broadcaster'];
            $this->pulses['low']++;
        }

        while (!empty($inputArray)) {
            $input = array_shift($inputArray);

            if ($exitWhenTurnedOn && $input['id'] === 'rx' && $input['pulse'] === 'low') {
                $this->machineTurnedOn = true;
                return;
            }

            if (isset($this->actionList['f'][$input['id']])) {
                // flip-flop
                if ($input['pulse'] === 'high') {
                    continue;
                }
                // low pulse
                if ($this->actionList['f'][$input['id']]['status'] === 'off') {
                    $this->actionList['f'][$input['id']]['status'] = 'on';
                    foreach ($this->actionList['f'][$input['id']]['steps'] as $nextStep) {
                        $inputArray[] = ['id' => $nextStep, 'pulse' => 'high', 'from' => $input['id']];
                        $this->pulses['high']++;
                    }
                } else {
                    $this->actionList['f'][$input['id']]['status'] = 'off';
                    foreach ($this->actionList['f'][$input['id']]['steps'] as $nextStep) {
                        $inputArray[] = ['id' => $nextStep, 'pulse' => 'low', 'from' => $input['id']];
                        $this->pulses['low']++;
                    }
                }

            } elseif (isset($this->actionList['c'][$input['id']])) {
                // Conjunction
                // update input
                $this->actionList['c'][$input['id']]['input'][$input['from']] = $input['pulse'];

                $newPulse = 'low';
                if (in_array('low', $this->actionList['c'][$input['id']]['input'], true)) {
                    $newPulse = 'high';
                }
                foreach ($this->actionList['c'][$input['id']]['steps'] as $nextStep) {
                    $inputArray[] = ['id' => $nextStep, 'pulse' => $newPulse, 'from' => $input['id']];
                    if ($newPulse === 'high') {
                        $this->pulses['high']++;
                    } else {
                        $this->pulses['low']++;
                    }

                }
            }
        }
    }
}