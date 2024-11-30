<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;

class Y2023D4Service implements DayServiceInterface
{
    public function generatePart1(array|\Generator $rows): string
    {
        $totalPoints = 0;
        foreach ($rows as $row) {
            if ($row === '') {
                continue;
            }
            $row = trim(preg_replace('/\r+/', '', $row));

            $row = preg_replace('/\s+/', ' ',$row);
            $rowData = explode(': ', $row);

            $separateData = explode(' | ', $rowData[1]);
            $winningNrs = explode(' ', $separateData[0]);
            $myNrs = explode(' ', $separateData[1]);

            $matchingNrs = array_intersect($winningNrs, $myNrs);
            if (!empty($matchingNrs)) {
                $pointsToAdd = 2 ** (count($matchingNrs) - 1);
                $totalPoints += $pointsToAdd;
            }
        }
        
        return (string)$totalPoints;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $trackingArray = [];

        foreach ($rows as $row) {
            if ($row === '') {
                continue;
            }
            $row = trim(preg_replace('/\r+/', '', $row));
            $row = preg_replace('/\s+/', ' ',$row);
            $rowData = explode(': ', $row);
            $cardId = (int)(explode(' ', $rowData[0]))[1];
            $separateData = explode(' | ', $rowData[1]);
            $winningNrs = explode(' ', $separateData[0]);
            $myNrs = explode(' ', $separateData[1]);
            $matchingNrs = array_intersect($winningNrs, $myNrs);

            if (!isset($trackingArray[$cardId])) {
                $trackingArray[$cardId] = 1;
            } else {
                $trackingArray[$cardId]++;
            }

            for ($i=1, $iMax = count($matchingNrs); $i<= $iMax; $i++) {
                if (!isset($trackingArray[$cardId+$i])) {
                    $trackingArray[$cardId+$i] = $trackingArray[$cardId];
                }else {
                    $trackingArray[$cardId+$i] += $trackingArray[$cardId];
                }
            }
        }

        return (string)array_sum($trackingArray);
    }
}
