<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;

class Y2023D1Service implements DayServiceInterface
{
    public function generatePart1(array|\Generator $rows): string
    {
        $total = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            $numbers = array_filter(preg_split("/\D+/", $row));
            if (!empty($numbers)) {
                $first = mb_substr(reset($numbers), 0, 1);
                $last = mb_substr(end($numbers), -1);
                $total += (int)($first.$last);
            }
        }

        return (string)$total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $numberStringOptions = [
            1 => "one",
            2 => "two",
            3 => "three",
            4 => "four",
            5 => "five",
            6 => "six",
            7 => "seven",
            8 => "eight",
            9 => "nine"
        ];

        $total = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            $inStringData = [
                'first' => null,
                'firstPosition' => null,
                'last' => null,
                'lastPosition' => null,
            ];
            foreach ($numberStringOptions as $int => $option) {
                $this->getInstringData($inStringData, $row, $option, $int);
            }

            foreach (array_keys($numberStringOptions) as $option) {
                $this->getInstringData($inStringData, $row, (string)$option);
            }

            $total += (int)($inStringData['first'].$inStringData['last']);
        }

        return (string)$total;
    }

    private function getInstringData(array &$inStringData, string $subString, string $option, ?int $key = null): void
    {
        $position = strpos($subString,$option);
        if (false !== $position) {
            if (null === $inStringData['firstPosition'] || $inStringData['firstPosition'] > $position) {
                $inStringData['firstPosition'] = $position;
                $inStringData['first'] = $key ?? (int)$option;
            }
        }
        $position = strrpos($subString,$option);
        if (false !== $position) {
            if (null === $inStringData['lastPosition'] || $inStringData['lastPosition'] < $position) {
                $inStringData['lastPosition'] = $position;
                $inStringData['last'] = $key ?? (int)$option;
            }
        }
    }
}
