<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\GridDumper;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D18')]
class D18Service implements DayServiceInterface
{
    public function __construct(public array $gridValues = [], public array $grid = [], public array $dimensions = [])
    {
    }

    public function generatePart1(array $rows): string
    {
        $this->createGridValues($rows);
        $this->createGrid();
//        dump($this->dimensions);
//        dump($this->gridValues);
        $inloop = $this->findTotalInLoop();
        $totalGridValue = $this->findTotalGridValues();
//        dump($inloop, $totalGridValue);
//        GridDumper::dumpGrid($this->grid, '');
//        dd($this->grid);
        return (string)($inloop + $totalGridValue);
    }

    public function generatePart2(array $rows): string
    {
        return '0';
    }

    private function findTotalGridValues(): int
    {
        $totalValue = 0;
        foreach ($this->gridValues as $row) {
            $totalValue += count($row);
        }

        return $totalValue;
    }

    private function findTotalInLoop(): int
    {
        $totalInloop = 0;
        foreach ($this->grid as $x => $xValue) {
            $inloop = 0;
            $lastDirection = '';
            for ($y=$this->dimensions['minY'];$y<=$this->dimensions['maxY'];$y++) {
                if (isset($this->gridValues[$x][$y])) {
                    if ($xValue[$y] === '-') {
                        continue;
                    }
                    if ($xValue[$y] === '|') {
                        $lastDirection = '';
                        $inloop = $inloop === 0 ? 1 : 0;
                        continue;
                    }
                    if ($xValue[$y] === 'F') {
                        $lastDirection = 'F';
                        continue;
                    }
                    if ($xValue[$y] === 'L') {
                        $lastDirection = 'L';
                        continue;
                    }

                    if ($lastDirection === 'F') {
                        if ($xValue[$y] === '7') {
                            $lastDirection = '';
                            continue;
                        }
                        if ($xValue[$y] === 'J') {
                            $lastDirection = '';
                            $inloop = $inloop === 0 ? 1 : 0;
                            continue;
                        }
                    }
                    if ($lastDirection === 'L') {
                        if ($xValue[$y] === 'J') {
                            $lastDirection = '';
                            continue;
                        }
                        if ($xValue[$y] === '7') {
                            $lastDirection = '';
                            $inloop = $inloop === 0 ? 1 : 0;
                            continue;
                        }
                    }
                }
                if ($inloop === 1) {
                    $totalInloop++;
                }
            }
        }

        return $totalInloop;
    }

    private function createGrid(): void
    {
        for ($x=$this->dimensions['minX'];$x<=$this->dimensions['maxX'];$x++) {
            for ($y=$this->dimensions['minY'];$y<=$this->dimensions['maxY'];$y++) {
                $boven = false;
                $beneden = false;
                $links = false;
                $rechts = false;
                // waar heb je omliggende velden
                // boven en rechts => L
                // boven en beneden => |
                // boven en links => J
                // onder en rechts => F
                // onder en links => 7
                // links en rechts => -
                if (isset($this->gridValues[$x-1][$y])) {
                    $boven = true;
                }
                if (isset($this->gridValues[$x+1][$y])) {
                    $beneden = true;
                }
                if (isset($this->gridValues[$x][$y-1])) {
                    $links = true;
                }
                if (isset($this->gridValues[$x][$y+1])) {
                    $rechts = true;
                }

                $field = '-';
                if ($boven && $rechts) {
                    $field = 'L';
                } elseif ($boven && $beneden) {
                    $field = '|';
                } elseif ($boven && $links) {
                    $field = 'J';
                } elseif ($beneden && $links) {
                    $field = '7';
                } elseif ($beneden && $rechts) {
                    $field = 'F';
                }

                $this->grid[$x][$y] = isset($this->gridValues[$x][$y]) ? $field : '.';
            }
        }
    }

    private function createGridValues($rows): void
    {
        //R 6 (#70c710)
        //D 5 (#0dc571)

        $x = 1000;
        $y = 1000;
        $this->dimensions = [
            'minX' => 1000,
            'maxX' => 1000,
            'minY' => 1000,
            'maxY' => 1000,
        ];
        $first = true;

        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if ('' === $row) {
                continue;
            }
            [$direction, $amount, $color] = explode(' ', $row);
            $color = substr($color, 1, -1);
            if ($first) {
                $this->gridValues[$x][$y] = $color;
                $first = false;
            }

            for ($i=1;$i<=$amount;$i++) {
                switch ($direction) {
                    case 'U':
                        $x--;
                        if ($x<$this->dimensions['minX']) {
                            $this->dimensions['minX'] = $x;
                        }
                        break;
                    case 'D':
                        $x++;
                        if ($x>$this->dimensions['maxX']) {
                            $this->dimensions['maxX'] = $x;
                        }
                        break;
                    case 'L':
                        $y--;
                        if ($y<$this->dimensions['minY']) {
                            $this->dimensions['minY'] = $y;
                        }
                        break;
                    case 'R':
                        $y++;
                        if ($y>$this->dimensions['maxY']) {
                            $this->dimensions['maxY'] = $y;
                        }
                        break;
                }
                $this->gridValues[$x][$y] = $color;
            }
        }
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}
