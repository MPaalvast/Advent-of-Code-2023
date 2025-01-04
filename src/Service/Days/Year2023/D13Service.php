<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D13')]
class D13Service implements DayServiceInterface
{
    public function generatePart1(array $rows): string
    {
        [$gridX, $gridY] = $this->getGrids($rows);

        return (string)$this->calculateResults($gridX, $gridY);
    }

    public function generatePart2(array $rows): string
    {
        [$gridX, $gridY] = $this->getGrids($rows);

        return (string)$this->calculateSmudgeResults($gridX, $gridY);
    }

    private function calculateResults(array $gridX, array $gridY): int
    {
        $result = 0;
        foreach ($gridX as $key => $grid) {
            $rowId = $this->findMiddle($grid);
            if ($rowId > 0) {
                $result += ($rowId*100);
            }
        }
        foreach ($gridY as $key => $grid) {
            $rowId = $this->findMiddle($grid);
            if ($rowId > 0) {
                $result += $rowId;
            }
        }

        return $result;
    }

    private function findMiddle(array $grid): int
    {
        $rowId = 0;
        $maxNr = count($grid)-1;
        for ($i=0;$i<$maxNr;$i++) {
            if ($grid[$i] === $grid[$i+1]) {
                $done = true;
                for ($y=$i-1,$z=$i+2;$y>=0&&$z<=$maxNr;$y--, $z++) {
                    if ($grid[$y] !== $grid[$z]) {
                        $done = false;
                        break;
                    }
                }
                if ($done) {
                    $rowId = $i+1;
                    break;
                }
            }
        }
        return $rowId;
    }

    private function getGrids($rows): array
    {
        $i = 1;
        $gridX = [];
        $gridY = [];
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                $i++;
            } else {
                $rowValues = str_split($row);

                $gridX[$i][] = $rowValues;
                foreach ($rowValues as $collumn => $value) {
                    $gridY[$i][$collumn][] = $value;
                }
            }
        }

        return [$gridX, $gridY];
    }

    private function calculateSmudgeResults(array $gridX, array $gridY): int
    {
        $result = 0;
        foreach ($gridX as $key => $grid) {
            $rowId = $this->findMiddleWithSmudge($grid);
            if ($rowId > 0) {
                $result += ($rowId*100);
            }
        }
        foreach ($gridY as $key => $grid) {
            $rowId = $this->findMiddleWithSmudge($grid);
            if ($rowId > 0) {
                $result += $rowId;
            }
        }

        return $result;
    }

    private function findMiddleWithSmudge(array $grid): int
    {
        $rowId = 0;
        $maxNr = count($grid)-1;
        for ($i=0;$i<$maxNr;$i++) {
            $smudge = 0;
            $rowDiff = array_diff_assoc($grid[$i],$grid[$i+1]);
            if ($grid[$i] === $grid[$i+1] || count($rowDiff) === 1) {
                $done = true;
                if (count($rowDiff) > 0) {
                    $smudge += count($rowDiff);
                }
                for ($y=$i-1,$z=$i+2;$y>=0&&$z<=$maxNr;$y--, $z++) {
                    $rowDiff = array_diff_assoc($grid[$y],$grid[$z]);
                    if (count($rowDiff) > 0) {
                        $smudge += count($rowDiff);
                    }
                    if (($grid[$y] !== $grid[$z] && $smudge === 0) || $smudge > 1) {
                        $done = false;
                        break;
                    }
                }
                if ($done && $smudge === 1) {
                    $rowId = $i+1;
                    break;
                }
            }
        }
        return $rowId;
    }
}
