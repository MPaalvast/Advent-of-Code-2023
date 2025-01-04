<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D15')]
class D15Service implements DayServiceInterface
{
    public function generatePart1(array|\Generator $rows): string
    {
        $stringParts = $this->getStringParts($rows);

        $total = 0;
        foreach ($stringParts as $subString) {
            $total += $this->calculateValue($subString);
        }

        return (string)$total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $stringParts = $this->getStringParts($rows);
        $boxes = $this->getBoxes($stringParts);

        return (string)$this->calculateBoxValues($boxes);
    }

    private function getStringParts(array|\Generator $rows): array
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
