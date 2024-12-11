<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D11')]
class Y2024D11Service implements DayServiceInterface
{
    private string $title = "Plutonian Pebbles";
    private int $total = 0;
    private array $stones = [];
    private int $iterations = 25;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->getStones($rows);
        $this->calculateStonesTotal();

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        // 75 is too much
        // find loops and calculate the result instead of looping over them
        // loop definition
//            $loop[0] = [
//                'step 1' => 1,
//                'step 2' => 1,
//                'step 3' => 2,
//                'step 4' => 4,
//            ];
//            $loop[1] = [
//                'step 1' => 1,
//                'step 2' => 2,
//                'step 3' => 3,
//            ];
        // if loop already exists
            // calculate the remaining stones ot het existing loops and the remaining iterations

        // zie einde pagina voor de uitwerking van het demo voorbeeld.

        $this->iterations = 75;
        $this->getStones($rows);
        $this->calculateStonesTotal();

        return $this->total;
    }

    private function getStones(array|\Generator $rows): void
    {
        foreach ($rows as $row) {
            $this->stones = explode(' ', $row);
        }
    }
    public function calculateStonesTotal(): void
    {
        foreach ($this->stones as $stone) {
            $stoneArray = [$stone];
            $i = 0;
            while ($i < $this->iterations) {
                $newArray = [];
                foreach ($stoneArray as $stoneValue) {
                    if ($stoneValue === 0) {
                        $newArray[] = 1;
                    } elseif (strlen($stoneValue)%2 === 0) {
                        $newArray[] = (int)(substr($stoneValue, 0, (strlen($stoneValue)/2))); //??? -1
                        $newArray[] = (int)(substr($stoneValue, strlen($stoneValue)/2)); //??? -1
                    } else {
                        $newArray[] = $stoneValue * 2024;
                    }
                }
                $stoneArray = $newArray;
                $i++;
            }

            $this->total += count($stoneArray);
        }
    }
}
//125			= 1
//17			= 1
//
//253000 		= 1
//1 			= 1
//7			    = 1
//
//253 		    = 1
//0 			= 1
//2024 		    = 1
//14168		    = 1
//
//512072 		= 1
//1 			= 1
//20 			= 1
//24 			= 1
//28676032	    = 1
//
//512 		    = 1
//72 			= 1
//2024 		    = 1
//2 			= 2
//0 			= 1
//4 			= 1
//2867 		    = 1
//6032		    = 1
//
//1036288 	    = 1
//7 			= 1
//2 			= 1
//20 			= 1
//24 			= 1
//4048 		    = 2
//1 			= 1
//8096 		    = 1
//28 			= 1
//67 			= 1
//60 			= 1
//32			= 1
//
//2097446912 	= 1
//14168 		= 1
//4048 		    = 1
//2 			= 4
//0 			= 2
//4 			= 1
//40 			= 2
//48 			= 2
//2024 		    = 1
//80 			= 1
//96 			= 1
//8 			= 1
//6 			= 2
//7 			= 1
//3 			= 1
