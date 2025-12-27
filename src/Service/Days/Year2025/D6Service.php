<?php

namespace App\Service\Days\Year2025;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2025D6')]
class D6Service implements DayServiceInterface
{
    private array $mathLists = [];
    private array $results = [];
    public function generatePart1(array $rows): string
    {
        $this->createLists($rows);
        $this->calculateResults();

        return array_sum($this->results);
    }

    public function generatePart2(array $rows): string
    {
        $this->createListsTopDown($rows);
        $this->calculateResults();

        return array_sum($this->results);
    }

    private function calculateResults(): void
    {
        foreach ($this->mathLists as $mathList) {
            if ($mathList['operation'] === '+') {
                $this->results[] = array_sum($mathList['values']);
            } else {
                $this->results[] = array_product($mathList['values']);
            }
        }
    }

    private function createListsTopDown(array $rows): void
    {
        $totalRows = count($rows) - 1;
        $lastRow = $rows[$totalRows];
        foreach ($rows as $key => $row) {
            if ($totalRows === $key) {
                continue;
            }

            if ($key === 0) {
                $data = str_split($row);
            } else {
                $test = str_split($row);
                foreach ($test as $keyT => $item) {
                    $data[$keyT] .= $item;
                }
            }
        }
        $y = 0;

        foreach ($data as $key => $number) {
            if (isset($lastRow[$key]) && ($lastRow[$key] === '+' || $lastRow[$key] === '*')) {
                $this->mathLists[$y] = [
                    'values' => [trim($number)],
                    'operation' => $lastRow[$key]
                ];
                continue;
            }
            if (trim($number) === '') {

                $y++;
                continue;
            }
            $this->mathLists[$y]['values'][] = trim($number);
        }
    }

    private function createLists(array $rows): void
    {
        $totalRows = count($rows) - 1;
        foreach ($rows as $key => $row) {
            $rowData = explode(' ',trim(preg_replace('/\s+/', ' ', $row)));
            foreach ($rowData as $rowKey => $rowPart) {
                if (!isset($this->mathLists[$rowKey])) {
                    $this->mathLists[$rowKey] = [
                        'values' => [$rowPart],
                        'operation' => ''
                    ];
                    continue;
                }
                if ($totalRows === $key) {
                    $this->mathLists[$rowKey]['operation'] = $rowPart;
                } else {
                    $this->mathLists[$rowKey]['values'][] = $rowPart;
                }
            }

        }
    }

    public function isValidInput(array $rows): bool
    {
        $totalRows = count($rows) - 1;
        foreach ($rows as $key => $row) {
            if ($key === $totalRows) {
                preg_match('/^[\s*+]+$/', $row, $matches);
                if (empty($matches)) {
                    return false;
                }
            } else {
                preg_match('/^\s*\d+(?:\s+\d+)*\s*$/', $row, $matches);
                if (empty($matches)) {
                    return false;
                }
            }
        }
        return true;
    }
}