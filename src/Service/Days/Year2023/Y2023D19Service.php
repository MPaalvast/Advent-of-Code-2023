<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D19')]
class Y2023D19Service implements DayServiceInterface
{
    private string $title = "Aplenty";

    public function getTitle(): string
    {
        return $this->title;
    }

    public function __construct(public array $functionList = [], public array $inputList = [], public int $value = 0)
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->getInputData($rows);
        $this->generateValue();
        return (string)$this->value;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $this->getInputData($rows, true);
        $this->inputList[] = [
            'action' => 'in',
            'value' => [
                'x' => ['min' => 1, 'max' => 4000],
                'm' => ['min' => 1, 'max' => 4000],
                'a' => ['min' => 1, 'max' => 4000],
                's' => ['min' => 1, 'max' => 4000],
            ],
        ];
        $this->generateRangeValue();

        return (string)$this->value;
    }

    private function generateRangeValue(): void
    {
        while (!empty($this->inputList)) {
            $input = array_shift($this->inputList);
            $function = $this->functionList[$input['action']];
            foreach ($function as $key => $functionAction) {
                if ($key === 'next') {
                    if (in_array($functionAction, ['A', 'R'])) {
                        $this->calculateRangeValue($functionAction, $input['value']);
                        continue 2;
                    }

                    $input['action'] = $functionAction;
                    $this->inputList[] = $input;

                    continue 2;
                }
                if (isset($input['value'][$functionAction['key']])) {
                    if ($functionAction['typeCompare'] === '>') {
                        if ($input['value'][$functionAction['key']]['min'] > $functionAction['valueCompare']) {
                            if (in_array($functionAction['next'], ['A', 'R'])) {
                                $this->calculateRangeValue($functionAction['next'], $input['value']);
                            } else {
                                $input['action'] = $functionAction['next'];
                                $this->inputList[] = $input;
                            }
                            continue 2;
                        }
                        if ($input['value'][$functionAction['key']]['max'] > $functionAction['valueCompare']) {
                            // haal de range eruit die voldoet aan deze voorwaarde en zet die range er opnieuw in $this->inputList[]
                            $newInput = [];
                            $newInput['action'] = $functionAction['next'];
                            $newInput['value'] = [
                                'x' => $input['value']['x'],
                                'm' => $input['value']['m'],
                                'a' => $input['value']['a'],
                                's' => $input['value']['s'],
                            ];
                            $newInput['value'][$functionAction['key']]['min'] = (int)$functionAction['valueCompare']+1;
                            if (in_array($functionAction['next'], ['A', 'R'])) {
                                $this->calculateRangeValue($functionAction['next'], $newInput['value']);
                            } else {
                                $newInput['action'] = $functionAction['next'];
                                $this->inputList[] = $newInput;
                            }
                            // de range die niet overeenkomt moet verder verwerkt worden
                                // update $input['value'] met de overgebleven range
                            $input['value'][$functionAction['key']]['max'] = (int)$functionAction['valueCompare'];
                        }
                    }
                    if ($functionAction['typeCompare'] === '<') {
                        if ($input['value'][$functionAction['key']]['max'] < $functionAction['valueCompare']) {
                            if (in_array($functionAction['next'], ['A', 'R'])) {
                                $this->calculateRangeValue($functionAction['next'], $input['value']);
                            } else {
                                $input['action'] = $functionAction['next'];
                                $this->inputList[] = $input;
                            }
                            continue 2;
                        }
                        if ($input['value'][$functionAction['key']]['min'] < $functionAction['valueCompare']) {
                            // haal de range eruit die voldoet aan deze voorwaarde en zet die range er opnieuw in $this->inputList[]
                            $newInput = [];
                            $newInput['action'] = $functionAction['next'];
                            $newInput['value'] = [
                                'x' => $input['value']['x'],
                                'm' => $input['value']['m'],
                                'a' => $input['value']['a'],
                                's' => $input['value']['s'],
                            ];
                            $newInput['value'][$functionAction['key']]['max'] = $functionAction['valueCompare']-1;
                            if (in_array($functionAction['next'], ['A', 'R'])) {
                                $this->calculateRangeValue($functionAction['next'], $newInput['value']);
                            } else {
                                $newInput['action'] = $functionAction['next'];
                                $this->inputList[] = $newInput;
                            }
                            // de range die niet overeenkomt moet verder verwerkt worden
                            // update $input['value'] met de overgebleven range
                            $input['value'][$functionAction['key']]['min'] = (int)$functionAction['valueCompare'];
                        }
                    }
                }
            }
        }
    }

    private function generateValue(): void
    {
        while (!empty($this->inputList)) {
            $input = array_shift($this->inputList);
            $function = $this->functionList[$input['action']];
            foreach ($function as $key => $functionAction) {
                if ($key === 'next') {

                    if (in_array($functionAction, ['A', 'R'])) {
                        $this->calculateValue($functionAction, $input['value']);
                        continue 2;
                    }

                    $input['action'] = $functionAction;
                    $this->inputList[] = $input;

                    continue 2;
                }
                if (isset($input['value'][$functionAction['key']])) {
                    if ($functionAction['typeCompare'] === '>') {
                        if ($input['value'][$functionAction['key']] > $functionAction['valueCompare']) {
                            if (in_array($functionAction['next'], ['A', 'R'])) {
                                $this->calculateValue($functionAction['next'], $input['value']);
                            } else {
                                $input['action'] = $functionAction['next'];
                                $this->inputList[] = $input;
                            }

                            continue 2;
                        }
                    }
                    if ($functionAction['typeCompare'] === '<') {
                        if ($input['value'][$functionAction['key']] < $functionAction['valueCompare']) {
                            if (in_array($functionAction['next'], ['A', 'R'])) {
                                $this->calculateValue($functionAction['next'], $input['value']);
                            } else {
                                $input['action'] = $functionAction['next'];
                                $this->inputList[] = $input;
                            }

                            continue 2;
                        }
                    }
                }
            }
        }
    }

    private function calculateRangeValue(string $type, array $dataToCalculate): void
    {
        if ($type === 'A') {
            $valueX = $dataToCalculate['x']['max'] === $dataToCalculate['x']['min'] ? 1 : ($dataToCalculate['x']['max'] - $dataToCalculate['x']['min'])+1;
            $valueM = $dataToCalculate['m']['max'] === $dataToCalculate['m']['min'] ? 1 : ($dataToCalculate['m']['max'] - $dataToCalculate['m']['min']+1);
            $valueA = $dataToCalculate['a']['max'] === $dataToCalculate['a']['min'] ? 1 : ($dataToCalculate['a']['max'] - $dataToCalculate['a']['min']+1);
            $valueS = $dataToCalculate['s']['max'] === $dataToCalculate['s']['min'] ? 1 : ($dataToCalculate['s']['max'] - $dataToCalculate['s']['min']+1);
            $this->value += ($valueX * $valueM * $valueA * $valueS);
        }
    }
    private function calculateValue(string $type, array $dataToCalculate): void
    {
        if ($type === 'A') {
            $this->value += array_sum($dataToCalculate);
        }
    }

    private function getInputData($rows, bool $functionOnly = false): void
    {
        $getFunctions = true;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if ('' === $row) {
                $getFunctions = false;
                if ($functionOnly) {
                    break;
                }

                continue;
            }
            if ($getFunctions) {
                $this->createFunctionData($row);
            } else {
                $this->createInputData($row);
            }
        }
    }

    private function createFunctionData($row):void
    {
        [$fName, $fData] = explode('{', $row);

        $this->functionList[$fName] = [];
        $fDataParts = explode(',', substr($fData, 0, -1));
        foreach ($fDataParts as $fDataPart) {

            if (strpos($fDataPart, ':') === false) {
                $this->functionList[$fName]['next'] = $fDataPart;
                continue;
            }
            [$logic, $next] = explode(':', $fDataPart);
            $type = strpos($logic, '>') ? '>' : '<';
            [$key, $value] = explode($type, $logic);
            $this->functionList[$fName][] = [
                'key' => $key,
                'typeCompare' => $type,
                'valueCompare' => $value,
                'next' => $next,
            ];
        }
    }

    private function createInputData($row):void
    {
        $valueArray = [];
        $rowParts = explode(',', substr($row, 1, -1));
        foreach ($rowParts as $rowPart) {
            [$key, $value] = explode('=', $rowPart);
            $valueArray[$key] = $value;
        }
        $this->inputList[] = [
            'action' => 'in',
            'value' => $valueArray
        ];
    }
}
