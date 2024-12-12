<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D12')]
class D12Service implements DayServiceInterface
{
    private string $title = "Garden Groups";
    private int $total = 0;
    private array $grid = [];
    private array $regions = [];
    private array $currentRegion = [];
    private array $knownRegionFields = [];

    public function getTitle(): string
    {
        return $this->title;
    }

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

    public function generatePart1(array|\Generator $rows): string
    {
        $this->generateGrid($rows);
        $this->generateRegionArray();
        $this->calculateBorders();

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return $this->total;
    }

    //
    // helper functions below
    //

    private function calculateBorders(): void
    {
        foreach ($this->regions as $region) {
            $this->total += (count($region) * array_sum($region));
        }
    }

    private function generateGrid(array|\Generator  $rows): void
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
    
    private function generateRegionArray()
    {
        foreach ($this->grid as $x => $row) {
            foreach ($row as $y => $regionValue) {
                if (!in_array($x . '-' . $y, $this->knownRegionFields, true)) {
                    $this->makeRegion($x, $y, $regionValue);
                }
            }
        }
    }

    private function makeRegion(int $x, int $y, string $regionValue)
    {
        $this->currentRegion = [];
        $this->findNeighbourRegions([['x' => $x, 'y' => $y]], $regionValue);
        
        $this->regions[] = $this->currentRegion;
    }

    private function findNeighbourRegions(array $regionFields, string $regionValue)
    {
        $allNextRegionFields = [];
        foreach ($regionFields as $field) {
            if (in_array($field['x'] . '-' . $field['y'], $this->knownRegionFields, true)) {
                continue;
            }

            $nextRegionFields = $this->getRegionFields($field, $regionValue);
            $this->knownRegionFields[] = $field['x'] . '-' . $field['y'];
            $this->currentRegion[$field['x'] . '-' . $field['y']] = 4-count($nextRegionFields);

            $nextRegionFields = $this->removeKnownRegionFields($nextRegionFields);
            $allNextRegionFields = array_merge($allNextRegionFields, $nextRegionFields);
        }
        if (!empty($allNextRegionFields)) {
            $this->findNeighbourRegions($allNextRegionFields, $regionValue);
        }
    }

    private function removeKnownRegionFields(array $nextRegionFields): array
    {
        foreach ($nextRegionFields as $key => $field) {
            if (in_array($field['x'] . '-' . $field['y'], $this->knownRegionFields, true)) {
                unset($nextRegionFields[$key]);
            }
        }

        return $nextRegionFields;
    }

    private function getRegionFields(array $field, string $regionValue): array
    {
        $nextRegionFields = [];
        // look up
        if ($this->checkRegionField(['x' => $field['x']-1, 'y' => $field['y']], $regionValue)) {
            $nextRegionFields[] = ['x' => $field['x']-1, 'y' => $field['y']];
        }
        // look right
        if ($this->checkRegionField(['x' => $field['x'], 'y' => $field['y']+1], $regionValue)) {
            $nextRegionFields[] = ['x' => $field['x'], 'y' => $field['y']+1];
        }
        // look down
        if ($this->checkRegionField(['x' => $field['x']+1, 'y' => $field['y']], $regionValue)) {
            $nextRegionFields[] = ['x' => $field['x']+1, 'y' => $field['y']];
        }
        // look left
        if ($this->checkRegionField(['x' => $field['x'], 'y' => $field['y']-1], $regionValue)) {
            $nextRegionFields[] = ['x' => $field['x'], 'y' => $field['y']-1];
        }

        return $nextRegionFields;
    }

    private function checkRegionField(array $array, string $regionValue): bool
    {
        if (!isset($this->grid[$array['x']][$array['y']])) {
            return false;
        }
        if ($this->grid[$array['x']][$array['y']] !== $regionValue) {
            return false;
        }

        return true;
    }

    // "0-125" => 3
    // "1-125" => 1
    // "2-125" => 1
    // "1-124" => 1
    // "3-125" => 3
    // "2-124" => 2
    // "1-123" => 2
    // "1-122" => 3

    //    0
    // 0000
    //   00
    //    0
    // BBB BBB BBB BBB BBB
    // BAB BAA BAA AAA BBA
    // BBB BBB BAB BBB BAA

    // first field
        // 0 neighbours => 4 sides
        // 1 neighbour  => 3 sides
        // 2 neighbours => 2 sides
    // the rest
        // 1 neighbour
            // check the fields next to the 1 neighbour in your 9 square grid
                // 0 => 1 side
                // 1 => 2 sides
                // 2 => 3 sides
        // 2 neighbours
            //
        // 3 neighbours

    // if a field has 0 neighbours
        // add 4 sides to the region
    // if a field has 1 neighbour
        // check the 2 diagonal fields on the side that has a neighbour
            // if 0 is in the region
                // add 1 side to the region
            // if 1 is in the region
                // add 2 sides to the region
            // if 2 is in the region
                // add 3 sides to the region
        // add 3 sides to the region
    // if a field has 2 neighbours
        // add 1 side to the region
    // if a field has 3 neighbours
        // check the 2 diagonal fields on the side that has no neighbour
        // if
}