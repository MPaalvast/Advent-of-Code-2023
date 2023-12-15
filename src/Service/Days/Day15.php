<?php

namespace App\Service\Days;

class Day15
{
    public function generatePart1($rows): string
    {
        $stringParts = $this->getStringParts($rows);

        $total = 0;
        foreach ($stringParts as $subString) {
            $total += $this->calculateValue($subString);
        }

        return $total;
    }

    private function getStringParts(array $rows): array
    {
        $totalString = '';
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            $totalString .= $row;
        }
        return explode(',', $totalString);
    }

    private function calculateValue(string $string): int
    {
        $value = 0;
        $stringParts = unpack("C*", $string);

        foreach ($stringParts as $stringPart) {
            $value += $stringPart;
            $value *= 17;
            $value %= 256;
        }

        return $value;
    }

    public function generatePart2($rows): string
    {
        $stringParts = $this->getStringParts($rows);
        $boxes = $this->getBoxes($stringParts);

        return $this->calculateBoxValues($boxes);
    }

    private function calculateBoxValues(array $boxes): int
    {
        $total = 0;
        foreach ($boxes as $boxKey => $boxLenses) {
            $boxValue = $boxKey+1;
            $i=1;
            foreach ($boxLenses as $lensNr) {
                $total += ($boxValue * $i * $lensNr);
                $i++;
            }
        }

        return $total;
    }

    private function getBoxes(array $stringParts): array
    {
        $boxes = [];
        foreach ($stringParts as $subString) {
            $separator = '-';
            if (str_contains($subString, '=')) {
                $separator = '=';
            }
            [$label, $focalLength] = explode($separator, $subString);
            $boxNr = $this->calculateValue($label);
            if ($separator === '=') {
                $boxes[$boxNr][$label] = $focalLength;
            } elseif (isset($boxes[$boxNr][$label])) {
                unset($boxes[$boxNr][$label]);
                if (empty($boxes[$boxNr])) {
                    unset($boxes[$boxNr]);
                }
            }
        }

        return $boxes;
    }
}
