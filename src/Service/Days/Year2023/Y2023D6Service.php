<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;

class Y2023D6Service implements DayServiceInterface
{
    private string $title = "Wait For It";

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $timeStringData = [];
        $distanceStringData = [];

        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));

            if (empty($row)) {
                break;
            }
            if (empty($timeStringData)) {
                $timeStringData = explode(': ', preg_replace('/\s+/', ' ',$row));
            } else {
                $distanceStringData = explode(': ', preg_replace('/\s+/', ' ',$row));
            }
        }

        $timeArray = explode (' ', $timeStringData[1]);
        $distanceArray = explode (' ', $distanceStringData[1]);

        return (string)$this->getNumberOfWays($timeArray, $distanceArray);
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $timeStringData = [];
        $distanceStringData = [];

        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));

            if (empty($row)) {
                break;
            }
            if (empty($timeStringData)) {
                $timeStringData = explode(':', preg_replace('/\s+/', '',$row));
            } else {
                $distanceStringData = explode(':', preg_replace('/\s+/', '',$row));
            }
        }

        $timeArray = explode (' ', $timeStringData[1]);
        $distanceArray = explode (' ', $distanceStringData[1]);

        return (string)$this->getNumberOfWays($timeArray, $distanceArray);
    }

    private function getNumberOfWays($timeArray, $distanceArray): int
    {
        $result = 1;
        foreach ($timeArray as $key => $time) {
            $halftime = (int)$time/2;
            $i = (int)floor($halftime);
            $totalTimeToPush = 0;

            while ($i * ((int)$time-$i) > (int)$distanceArray[$key]) {
                $totalTimeToPush++;
                --$i;
            }
            $totalTimeToPush *= 2;
            if ($time%2 === 0) {
                $totalTimeToPush--;
            }
            $result *= $totalTimeToPush;
        }

        return $result;
    }
}
