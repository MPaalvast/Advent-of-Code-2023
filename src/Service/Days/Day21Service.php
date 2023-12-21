<?php

declare(strict_types=1);

namespace App\Service\Days;

use App\Service\Tools\GridDumper;

class Day21Service implements DayServiceInterface
{
    public function __construct(public array $grid = [], public string $start = '', public array $blockedFields = [], public array $steps = [])
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->handleInput($rows);
        dump($this->start);
        dump($this->blockedFields);
        GridDumper::dumpGrid($this->grid, '');
        dd('');
        return '0';
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return '0';
    }

    private function walkStep(int $stepNr): void
    {
        // if $stepNr = 1
        // use $this->start as value to walk from

        // oddNewSteps
        // oddSteps
        // evenNewSteps
        // evenSteps
        // allSteps
        if (($stepNr%2) === 0) {
            //even
            // for every evenNewSteps
            // find new possible fields that are not in oddSteps
            // update evenNewSteps with new fields
            // update evenSteps
            // update allSteps
        } else {
            // odd
            // for every oddNewSteps
            // find new possible fields that are not in evenSteps
            // update oddNewSteps with new fields
            // update oddSteps
            // update allSteps
        }
    }

    private function getNextFields(array $newSteps): array
    {
        $nextFields = [];
        foreach ($newSteps as $step) {
            [$x,$y] = explode('-', $step);
            $idUp = ($x-1) . '-' . $y;
            $idDown = ($x+1) . '-' . $y;
            $idLeft = $x . '-' . ($y-1);
            $idRight = $x . '-' . ($y+1);
            if (!isset($this->steps['allSteps'][$idUp]) && !isset($this->blockedFields[$idUp])) {
                $nextFields[] = $idUp;
            }
            if (!isset($this->steps['allSteps'][$idDown]) && !isset($this->blockedFields[$idDown])) {
                $nextFields[] = $idDown;
            }
            if (!isset($this->steps['allSteps'][$idLeft]) && !isset($this->blockedFields[$idLeft])) {
                $nextFields[] = $idLeft;
            }
            if (!isset($this->steps['allSteps'][$idRight]) && !isset($this->blockedFields[$idRight])) {
                $nextFields[] = $idRight;
            }
        }
        return $nextFields;
    }

    private function handleInput(array|\Generator$input): void
    {
        $i = 0;
        foreach ($input as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            $this->grid[$i] = str_split($row);

            // get blocked fields
            $result = array_keys( $this->grid[$i], "#" );
            foreach ($result as $key) {
                $this->blockedFields[$i . '-' . $key] = $i . '-' . $key;
            }

            // get startingPoint
            $value = array_keys( $this->grid[$i], "S" );
            if (!empty($value)) {
                $this->start = $i.'-'.$value[0];
            }

            $i++;
        }
    }
}
