<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D7')]
class D7Service implements DayServiceInterface
{
    private int|string $total = 0;
    private array $actions = [];
    private array $result = [];

    public function generatePart1(array $rows): string
    {
        $this->init($rows);
        $this->renderActions();
        if ($this->total !== 0) {
            return $this->total;
        }
        $this->setTotal();
        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->init($rows);
        $this->renderActions();
        if ($this->total !== 0) {
            return $this->total;
        }
        $bResult = $this->result['a'];
        $this->reset();
        $this->init($rows);
        $this->result['b'] = $bResult;
        $this->renderActions();
        if ($this->total !== 0) {
            return $this->total;
        }
        $this->setTotal();
        return $this->total;
    }

    private function setTotal(): void
    {
        ksort($this->result);
        $key = array_key_first($this->result);
        $this->total = $this->result[$key] ?? 0;
    }

    private function reset(): void
    {
        $this->result = [];
        $this->actions = [];
    }

    private function init(array $rows): void
    {
        foreach ($rows as $row) {
            $rowParts = explode(' ', $row);
            if (in_array($rowParts[1], ['AND', 'OR', 'RSHIFT', 'LSHIFT'], true)) {
                $this->setActions($rowParts[1], [$rowParts[0], $rowParts[2]], $rowParts[4]);
            } elseif ($rowParts[0] === 'NOT') {
                $this->setActions($rowParts[0], [$rowParts[1]], $rowParts[3]);
            } elseif (is_numeric($rowParts[0])) {
                $this->setResult($rowParts[2], $rowParts[0]);
            } else {
                $this->setActions('SAME', [$rowParts[0]], $rowParts[2]);
            }
        }
    }

    private function setActions(string $action, array $inputFields, string $outputField): void
    {
        $this->actions[] = [
            'type' => $action,
            'inputFields' => $inputFields,
            'outputField' => $outputField,
        ];
    }

    private function setResult(string $key, int $value): void
    {
        $this->result[$key] = $value;
    }

    private function renderActions(): void
    {
        $firstAction = null;
        while (!empty($this->actions)) {
            $currentAction = array_shift($this->actions);

            if ($firstAction !== null && $firstAction === $currentAction) {
                $this->total = "Loop found!";
                return;
            }
            if (null === $firstAction) {
                $firstAction = $currentAction;
            }
            if ($this->checkAction($currentAction)) {
                $this->handleAction($currentAction);
                $firstAction = null;
                continue;
            }
            $this->actions[] = $currentAction;
        }
    }

    private function checkAction(array $action): bool
    {
        foreach ($action['inputFields'] as $inputField) {
            if (is_numeric($inputField)) {
                continue;
            }
            if (!isset($this->result[$inputField])) {
                return false;
            }
        }
        return true;
    }

    private function handleAction($action): void
    {
        $this->setResult($action['outputField'], $this->executeAction($action['type'], $action['inputFields'][0], $action['inputFields'][1] ?? null));
    }

    private function setValue(string|int|null $inputValue):? int
    {
        if (is_numeric($inputValue)) {
            return (int)$inputValue;
        } elseif (is_string($inputValue)) {
            return (int)$this->result[$inputValue];
        }
        return null;
    }

    private function executeAction(string $type, string|int $inputFieldA, string|int|null $inputFieldB = null): int
    {
        $valueA = $this->setValue($inputFieldA);
        $valueB = $this->setValue($inputFieldB);

        return match ($type) {
            'AND' => $valueA & $valueB,
            'NOT' => bindec(substr(decbin(~ $valueA), -16)),
            'OR' => $valueA | $valueB,
            'RSHIFT' => $valueA >> $valueB,
            'LSHIFT' => $valueA << $valueB,
            'SAME' => $valueA,
        };
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^(([a-z0-9]+)|([a-z0-9]+ (AND|OR|LSHIFT|RSHIFT) [a-z1-9]+)|NOT [a-z1-9]+) -> [a-z1-9]+$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}