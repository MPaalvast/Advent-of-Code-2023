<?php

namespace App\Service\Days;

class Day13
{
    public function generatePart1($rows): string
    {
        // generate gridX
        // generate gridY

        // walk through each array and find same rows.
        // form that walk left and right to find the edge
        // if key = 0 or key = max grid value
        // return nr of startCollumn + 1

        $result = 0;
        $grid = [];
        $calculate = 'collumn';
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {

                dump($grid);
                $max = count($grid[0]);
                for ($i=0;$i<$max;$i++) {
                    if ($grid[$i] === $grid[$i+1]) {
                        $middle = true;
                        for ($y=$i-1;$y>=0;$y--) {
                            $opositeNr = $i-$y;
                            if ($opositeNr > $max) {

                            }
                        }
                        dd($i);
                    }
                }
                if ($calculate === 'row') {
                    // $result += $value;
                } else {
                    // $result += ($value*100);
                }
                continue;
            }
            $rowValues = str_split($row);

            if ($calculate === 'row') {
                $grid[] = $rowValues;
            } else {
                foreach ($rowValues as $collumn => $value) {
                    $grid[$collumn][] = $value;
                }
            }

        }
        return $result;
    }

    public function generatePart2($rows): string
    {
        return 0;
    }
}
