<?php

declare(strict_types=1);

namespace App\Service\Days;

class Day19Service implements DayServiceInterface
{
    public function __construct(public array $functionList = [], public array $inputList = [], public int $value = 0)
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->getInputData($rows);
//        dump($this->functionList);
//        dump($this->value);
//        dd($this->inputList);
        $this->generateValue();
        return (string)$this->value;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return '0';
    }

    private function generateValue(): void
    {
        while (!empty($this->inputList)) {
            $input = array_shift($this->inputList);
            $function = $this->functionList[$input['action']];
            dump($input['action']);
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

    private function calculateValue(string $type, array $dataToCalculate): void
    {
        if ($type === 'A') {
            $this->value += array_sum($dataToCalculate);
        }
    }

    private function getInputData($rows): void
    {
        $getFunctions = true;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if ('' === $row) {
                $getFunctions = false;
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
