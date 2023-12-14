<?php

namespace App\Service\Days;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Day14 extends AbstractController
{
    public function __construct(public array $grid = [], public int $result = 0)
    {
    }

    public function generatePart1($rows): string
    {
        $this->createGrid($rows);
        $this->moveRocksUp();
        $this->calculateResult();

        return $this->result;
    }

    private function createGrid($rows): void
    {
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $this->grid[] = str_split($row);
        }
    }

//    private function moveRocksUp(): void
//    {
//        // while kan eruit
//        // kijk per 0 hoever hij kan verplaatsen en verplaats hem
//        $moved = true;
//        while ($moved) {
//            $moved = false;
//            foreach ($this->grid as $gridRowNr => $gridRow) {
//                if ($gridRowNr === 0) {
//                    continue;
//                }
//                foreach ($gridRow as $fieldNr => $fieldValue) {
//                    if ($fieldValue === 'O' && $this->grid[$gridRowNr-1][$fieldNr] === '.') {
//                        $this->grid[$gridRowNr-1][$fieldNr] = 'O';
//                        $this->grid[$gridRowNr][$fieldNr] = '.';
//                        $moved = true;
//                    }
//                }
//            }
//        }
//    }

    private function moveRocksUp(): void
    {
        // while kan eruit
        // kijk per 0 hoever hij kan verplaatsen en verplaats hem
//        $moved = true;
//        while ($moved) {
//            $moved = false;
        dump($this->grid);
        foreach ($this->grid as $gridRowNr => $gridRow) {
            if ($gridRowNr === 0) {
                continue;
            }

            foreach ($gridRow as $fieldNr => &$fieldValue) {
                if ($fieldValue === 'O') {
                    $hasChanged = false;
                    $i=0;
                    while (!$hasChanged) {
                        dump($gridRowNr . '-' . $i . '===');
                        dump($this->grid[$gridRowNr-($i+1)][$fieldNr]);
                        if (!isset($this->grid[$gridRowNr-($i+1)][$fieldNr]) || in_array($this->grid[$gridRowNr-($i+1)][$fieldNr], ['#', 'O'], true)) {
                            dump('---');
                            $this->grid[$gridRowNr-$i][$fieldNr] = 'O';
                            $fieldValue = '.';
                            $hasChanged = true;
                            break 2;
                        }

                        $i++;
                    }
                }
            }
        }
//        }
    }

    private function calculateResult(): void
    {
        $gridTotalRowValue = count($this->grid);
        foreach ($this->grid as $gridRow) {
            $rowCounts = count(array_keys($gridRow, "O"));
            if ($rowCounts > 0) {
                $this->result += $rowCounts * $gridTotalRowValue;
            }
            $gridTotalRowValue--;
        }
    }

    public function generatePart2($rows): string
    {
        $totalCycles = 1000000000;
////        $this->createGrid($rows);
//        for ($i=1;$i<=$totalCycles;$i++) {
////            $this->moveRocksUp();
////            $this->moveRocksLeft();
////            $this->moveRocksDown();
////            $this->moveRocksRight();
//        }
        $i = 0;
        do {
            $this->moveRocksUp();
//            $this->moveRocksLeft();
//            $this->moveRocksDown();
//            $this->moveRocksRight();
            $i++;
        } while ($i<=$totalCycles);
        return 0;
    }
}
