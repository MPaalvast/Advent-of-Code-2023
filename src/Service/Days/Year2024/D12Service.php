<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D12')]
class D12Service implements DayServiceInterface
{
    private int $total = 0;
    private array $grid = [];
    private array $regions = [];
    private array $nextRegionFields = [];
    private string $regionValue = '';
    private bool $countRegionBorders = false;
    private array $regionBorders = [];
    private array $currentRegion = [];
    private int $currentRegionBorders = 0;
    private array $knownRegionFields = [];
    private array $testDump = [];

    // make grid array
    // start on top left '0-0'
    // get value and make new region
    // add '0-0' in the visited array
    // a region would look like
    // $region[0] = [
    //     '0-0' => 2,
    //     '0-1' => 3,
    // ];
    // $region[1] = [
    //     '1-0' => 2,
    //     '2-0' => 3,
    // ];
    // count($region[0]) = total fields in that region
    // array_sum($region[0]) = total edges in that region

    public function generatePart1(array $rows): string
    {
        $this->generateGrid($rows);
        $this->generateRegionArray();
        $this->calculateBorders();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->countRegionBorders = true;
        $this->generateGrid($rows);
        $this->generateRegionArray();
        $this->calculateStraitBorders();
        ksort($this->testDump);
        dump($this->testDump);

        return $this->total;
    }

    //
    // helper functions below
    //

    private function calculateBorders(): void
    {
        foreach ($this->regions as $region) {
            $this->total += (count($region['regionFields']) * array_sum($region['regionFields']));
        }
    }

    private function calculateStraitBorders(): void
    {
//        dump($this->total);
        foreach ($this->regions as $region) {
//            dump((count($region['regionFields']) * $region['straitBorders']));
            $this->total += (count($region['regionFields']) * $region['straitBorders']);
//            dump('Total = ' .$this->total);
        }
    }

    private function generateGrid(array  $rows): void
    {
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $gridRow = str_split($row);
            $this->grid[] = $gridRow;
        }
    }
    
    private function generateRegionArray(): void
    {
        foreach ($this->grid as $x => $row) {
            foreach ($row as $y => $regionValue) {
                if (!in_array($x . '-' . $y, $this->knownRegionFields, true)) {
                    $this->regionValue = $regionValue;
                    $this->makeRegion($x, $y);
                }
            }
        }
    }

    private function makeRegion(int $x, int $y): void
    {
        $this->currentRegion = [];
        $this->findNeighbourRegions([['x' => $x, 'y' => $y]]);
//        if ($this->regionValue === 'Y') {
//            dump('Y => ' . $this->currentRegionBorders);
//            dump('--------');
//        }
//        if (!isset($this->testDump[$this->regionValue])) {
//            $this->testDump[$this->regionValue] = [];
//        }
//        $this->testDump[$this->regionValue][] = count($this->currentRegion);
        dump('A region of ' . $this->regionValue . ' plants with price ' . count($this->currentRegion) . ' * ' . $this->currentRegionBorders . ' = ' . (count($this->currentRegion) * $this->currentRegionBorders));
        $this->regions[] = [
            'regionFields' => $this->currentRegion,
            'straitBorders' => $this->currentRegionBorders,
        ];

    }

    private function findNeighbourRegions(array $regionFields): void
    {
        $this->currentRegionBorders = 0;
        while (!empty($regionFields)) {
            $field = array_shift($regionFields);

            if (in_array($field['x'] . '-' . $field['y'], $this->knownRegionFields, true)) {
                continue;
            }
            $this->nextRegionFields = $this->getRegionFields($field);
            $this->knownRegionFields[] = $field['x'] . '-' . $field['y'];
            $this->currentRegion[$field['x'] . '-' . $field['y']] = 4-count($this->nextRegionFields);
            $this->removeKnownRegionFields();

            array_push($regionFields, ...$this->nextRegionFields);
        }
    }

    private function removeKnownRegionFields(): void
    {
        foreach ($this->nextRegionFields as $key => $field) {
            if (in_array($field['x'] . '-' . $field['y'], $this->knownRegionFields, true)) {
                unset($this->nextRegionFields[$key]);
            }
        }
    }

    private function getRegionFields(array $field): array
    {
        $nextRegionFields = [];
        $indexL = $field['x'] . '-' . $field['y']-1;
        $indexU = $field['x']-1 . '-' . $field['y'];
        $indexD = $field['x']+1 . '-' . $field['y'];
        $indexR = $field['x'] . '-' . $field['y']+1;
        $indexLU = $field['x']-1 . '-' . $field['y']-1;
        $indexLD = $field['x']+1 . '-' . $field['y']-1;
        $indexRU = $field['x']-1 . '-' . $field['y']+1;
        $indexRD = $field['x']+1 . '-' . $field['y']+1;

        $borders = 0;
        $borderType = '';
        // look up
        if ($this->checkRegionField(['x' => $field['x']-1, 'y' => $field['y']])) {
            $nextRegionFields[] = ['x' => $field['x']-1, 'y' => $field['y']];
        } elseif (
            $this->countRegionBorders &&
            (
                !isset($this->currentRegion[$indexL]) ||
                isset($this->currentRegion[$indexLU]) ||
                (
                    isset($this->grid[$field['x']-1][$field['y']-1]) &&
                    $this->grid[$field['x']-1][$field['y']-1] === $this->regionValue &&
                    $this->grid[$field['x']][$field['y']-1] === $this->regionValue
                )
            ) && (
                !isset($this->currentRegion[$indexR]) ||
                isset($this->currentRegion[$indexRU]) ||
                (
                    isset($this->grid[$field['x']-1][$field['y']+1]) &&
                    $this->grid[$field['x']-1][$field['y']+1] === $this->regionValue &&
                    $this->grid[$field['x']][$field['y']+1] === $this->regionValue
                )
            )
        ) {
            $this->currentRegionBorders++;
            $borderType .= ' U';
            $borders++;
        }
        // look right
        if ($this->checkRegionField(['x' => $field['x'], 'y' => $field['y']+1])) {
            $nextRegionFields[] = ['x' => $field['x'], 'y' => $field['y']+1];
        } elseif (
            $this->countRegionBorders &&
            (!isset($this->currentRegion[$indexU]) || isset($this->currentRegion[$indexRU]) || (isset($this->grid[$field['x']-1][$field['y']+1]) && $this->grid[$field['x']-1][$field['y']+1] === $this->regionValue && $this->grid[$field['x']-1][$field['y']] === $this->regionValue)) &&
            (!isset($this->currentRegion[$indexD]) || isset($this->currentRegion[$indexRD]) || (isset($this->grid[$field['x']+1][$field['y']+1]) && $this->grid[$field['x']+1][$field['y']+1] === $this->regionValue && $this->grid[$field['x']+1][$field['y']] === $this->regionValue))
        ) {
            $this->currentRegionBorders++;
            $borderType .= ' R';
            $borders++;
        }
        // look down
        if ($this->checkRegionField(['x' => $field['x']+1, 'y' => $field['y']])) {
            $nextRegionFields[] = ['x' => $field['x']+1, 'y' => $field['y']];
        } elseif (
            $this->countRegionBorders &&
            (!isset($this->currentRegion[$indexL]) || isset($this->currentRegion[$indexLD]) || (isset($this->grid[$field['x']+1][$field['y']-1]) && $this->grid[$field['x']+1][$field['y']-1] === $this->regionValue && $this->grid[$field['x']][$field['y']-1] === $this->regionValue)) &&
            (!isset($this->currentRegion[$indexR]) || isset($this->currentRegion[$indexRD]) || (isset($this->grid[$field['x']+1][$field['y']+1]) && $this->grid[$field['x']+1][$field['y']+1] === $this->regionValue && $this->grid[$field['x']][$field['y']+1] === $this->regionValue))
        ) {
            $this->currentRegionBorders++;
            $borderType .= ' D';
            $borders++;
        }
        // look left
        if ($this->checkRegionField(['x' => $field['x'], 'y' => $field['y']-1])) {
            $nextRegionFields[] = ['x' => $field['x'], 'y' => $field['y']-1];
        } elseif (
            $this->countRegionBorders &&
            (!isset($this->currentRegion[$indexU]) || isset($this->currentRegion[$indexLU]) || (isset($this->grid[$field['x']-1][$field['y']-1]) && $this->grid[$field['x']-1][$field['y']-1] === $this->regionValue  && $this->grid[$field['x']-1][$field['y']] === $this->regionValue)) &&
            (!isset($this->currentRegion[$indexD]) || isset($this->currentRegion[$indexLD]) || (isset($this->grid[$field['x']+1][$field['y']-1]) && $this->grid[$field['x']+1][$field['y']-1] === $this->regionValue  && $this->grid[$field['x']+1][$field['y']] === $this->regionValue))
        ) {
            $this->currentRegionBorders++;
            $borderType .= ' L';
            $borders++;
        }

//        if ($this->regionValue === 'Z') {
//            dump($field['x'] . '-' . $field['y'] . ' BorderTypes:' . $borderType . ' Borders:' . $borders);
//        }

        return $nextRegionFields;
    }

    private function checkRegionField(array $array): bool
    {
        if (!isset($this->grid[$array['x']][$array['y']])) {
            return false;
        }
        if ($this->grid[$array['x']][$array['y']] !== $this->regionValue) {
            return false;
        }

        return true;
    }

// 860761 => to low
// 867910 => to low
// 877626 => not correct

// 877492 is correct
}
