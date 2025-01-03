<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D24')]
class D24Service implements DayServiceInterface
{
    private string $title = "Crossed Wires";
    private int $total = 0;
    private array $actionStack = [];
    private array $data = [];
    private array $result = [];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->initInput($rows);
        $this->calculateResult();
        $this->getResult();

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return $this->total;
    }

    private function initInput(array|\Generator $rows): void
    {
        $action = 'data';
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                $action = 'actionStack';
                continue;
            }
            if ($action === 'data') {
                $this->setDataRow($row);
                continue;
            }

            if ($action === 'actionStack') {
                $this->setActionStackRow($row);
            }
        }
    }

    private function setDataRow(string $row): void
    {
        [$key, $value] = explode(': ', $row);
        $this->data[$key] = (int)$value;
    }

    private function setActionStackRow(string $row): void
    {
        $actionStackData = $this->getActionStackDataFromRow($row);
        $this->actionStack[] = $actionStackData;
    }

    private function getActionStackDataFromRow(string $row): array
    {
        [$actionData, $newDataKey] = explode(' -> ', $row);
        [$key1, $action, $key2] = explode(' ', $actionData);
        return [
            'resultKey' => $newDataKey,
            'action' => $action,
            'actionKeys' => [$key1, $key2],
        ];
    }

    private function calculateResult(): void
    {
        while (!empty($this->actionStack)) {
            $action = array_shift($this->actionStack);

            if (!$this->hasActionKeyData($action['actionKeys'])) {
                $this->actionStack[] = $action;
                continue;
            }

            $this->calculateNewValue($action);
        }
    }

    private function hasActionKeyData($actionKeys): bool
    {
        foreach ($actionKeys as $actionKey) {
            if (!isset($this->data[$actionKey])) {
                return false;
            }
        }

        return true;
    }

    private function calculateNewValue(array $actionData): void
    {
        $newValue = $this->getNewValue($actionData['action'], $actionData['actionKeys'][0], $actionData['actionKeys'][1]);
        if ($actionData['resultKey'][0] === 'z') {
            $this->result[$actionData['resultKey']] = $newValue;
        } else {
            $this->data[$actionData['resultKey']] = $newValue;
        }
    }

    private function getNewValue(string $action, string $key1, string $key2): int
    {
        match ($action){
            'AND' => $value = $this->calculateAnd($key1, $key2),
            'OR' => $value = $this->calculateOr($key1, $key2),
            'XOR' => $value = $this->calculateXor($key1, $key2),
        };

        return $value;
    }

    private function calculateAnd(string $key1, string $key2): int
    {
        if ($this->data[$key1] === 1 && $this->data[$key2] === 1) {
            return 1;
        }

        return 0;
    }

    private function calculateOr(string $key1, string $key2): int
    {
        if ($this->data[$key1] === 1 || $this->data[$key2] === 1) {
            return 1;
        }

        return 0;
    }

    private function calculateXor(string $key1, string $key2): int
    {
        if ($this->data[$key1] !== $this->data[$key2]) {
            return 1;
        }

        return 0;
    }

    private function getResult(): void
    {
        krsort($this->result);
        $string = implode('', $this->result);
        $this->total = bindec($string);
    }

    // while action stack
    // shift the first and check if fields ar available in the data array
    // if not availible pop them to the end of the action stack

    // if available then make the new value
    // if the key starts with z put them in the result array
    // else put them in the data array

    // data array = [
        // key => value,
        // key => value,
        // key => value,
    // ]

    // result array = [
    // key => value,
    // key => value,
    // key => value,
    // ]

    // action stack = [
        // [
            // 'resultKey' => '{resultKey}',
            // 'action' => 'AND/OR/XOR',
            // 'actionKeys' = ['{actionKey1}', '{actionKey2}'],
        // ]
    // ]
}
