<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D12')]
class Y2023D12Service implements DayServiceInterface
{
    private string $title = "Hot Springs";

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $result = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            [$patern, $input] = explode(' ', $row);
            $inputParts = explode(',', $input);
            $baseString = $this->setBaseString($inputParts);
            $lengthDiff = strlen($patern) - strlen($baseString);
            if ($lengthDiff === 0) {
                $result++;
            } else {
                $result += $this->calculateDiffStrings($baseString, $patern, $lengthDiff);
            }

        }

        return (string)$result;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return "Not yet solved :(";
//        $result = 0;
//        foreach ($rows as $row) {
//            $row = trim(preg_replace('/\r+/', '', $row));
//            if (empty($row)) {
//                continue;
//            }
//            [$patern, $input] = explode(' ', $row);
//            $newPatern = rtrim(str_repeat($patern . '.', 5), '.');
//            $newInput = rtrim(str_repeat($input . ',', 5), ',');
//
//            $inputParts = explode(',', $newInput);
//            $baseString = $this->setBaseString($inputParts);
//            $lengthDiff = strlen($newPatern) - strlen($baseString);
//            if ($lengthDiff === 0) {
//                $result++;
//            } else {
//                $result += $this->calculateDiffStrings($baseString, $newPatern, $lengthDiff);
//            }
//
//        }
//
//        return (string)$result;
    }

    private function calculateDiffStrings(string $baseString, string $patern, int $posibleDots): int
    {
        $paternLength = strlen($patern);
        $nrOfMatchingStrings = 0;
        $loopData = [$baseString];
        $y = 0;
        while (!empty($loopData)) {
            $string = array_shift($loopData);
            if (strlen($string) === $paternLength && substr_count($string, '-') === 0) {
                if (fnmatch($patern, $string)) {
                    $nrOfMatchingStrings++;
                }
                continue;
            }
            if ($y === 0) {
                for ($i=0;$i<=$posibleDots;$i++) {
                    $newString = Y2023D12Service . phpstr_repeat(".", $i) . $string;
                    if (strlen($newString) < $paternLength || (strlen($newString) === $paternLength && substr_count($newString, '-') > 0)) {
                        $loopData[] = $newString;
                    } elseif (strlen($newString) === $paternLength) {
                        if (fnmatch($patern, $newString)) {
                            $nrOfMatchingStrings++;
                        }
                        continue;
                    }
                }
            } else {
                $parts = substr_count($string, '-');
                if ($parts > 0) {
                    [$before, $after] = explode('-', $string, 2);
                    for ($i=0;$i<=$posibleDots;$i++) {
                        $newString = $before . '.' . str_repeat(".", $i) . $after;
                        if (strlen($newString) < $paternLength || (strlen($newString) === $paternLength && substr_count($newString, '-') > 0)) {
                            $loopData[] = $newString;
                        } elseif (strlen($newString) === $paternLength) {
                            if (fnmatch($patern, $newString)) {
                                $nrOfMatchingStrings++;
                            }
                            continue;
                        }
                    }
                } else {
                    $dotsToAdd = $paternLength - strlen($string);
                    if (fnmatch($patern, $string . str_repeat(".", $dotsToAdd))) {
                        $nrOfMatchingStrings++;
                    }
                }
            }
            $y++;
        }

        return $nrOfMatchingStrings;
    }

    private function setBaseString(array $inputParts): string
    {
        $baseString = '';
        foreach ($inputParts as $part) {
            if (!empty($baseString)) {
                $baseString .= '-';
            }
            $baseString .= str_repeat("#", (int)$part);
        }

        return $baseString;
    }
}
