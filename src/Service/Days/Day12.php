<?php

namespace App\Service\Days;

class Day12
{
    //$pattern = "example?.txt";
    //
    //$fileName = "example1.txt";
    //
    // fnmatch is the way to go
    //    if (fnmatch($pattern, $fileName)) {
    //        echo "The file name '$fileName' matches the pattern '$pattern'.\n";
    //    } else {
    //        echo "The file name '$fileName' does not match the pattern '$pattern'.\n";
    //    }
    public function generatePart1($rows): string
    {
        $patern = "?###????????";
        $parts = explode(',', "3,2,1");
        $baseString = "###.##.#";
        // "?###.##.#"

        // bekende patronen extraheren
        // .?. kan nooit ## worden
        //?.?.?#..## 2,2

        $test = [
            '?','.','?','.','?','#','.','.','#','#'
        ];
        // count values 3 x #  totaal = 4 (2+2) 4-3 = 1
        // 1 # en 2 .
        // ?.?.?#..##
        // ....##..##
        // ..#..#..##
        // #....#..##
        $test2 = [
            '#','#','.','#','#'
        ];

        // ?????#??????????# 6,1,6
        // ??####????.######

        // ???????.#???.?##?. 1,1,2,2,1,3
        //

        // pregmatch
        // ?? -> of . of #
        //


        $diff = strlen($patern) - strlen($baseString);
        for ($i=0;$i<=$diff;$i++) {
            //0,0,0,4
            //0,0,1,3
            //0,0,2,2
            //0,0,3,1
            //0,0,4,0
            //0,1,0,3
            //0,1,1,2
            //0,1,2,1
            //0,1,3,0
            //0,2,0,2
            //0,2,1,1
            //0,2,2,0
            //0,3,0,1
            //0,3,1,0
            //0,4,0,0
            //1,0,0,3
            //1,0,1,2
            //1,0,2,1
            //1,0,3,0
            //1,0,3,0
            //1,1,0,2
            //1,1,1,1
            //1,1,2,0
            //1,2,0,1
            //1,2,1,0
            //1,3,0,0
        }
        //???????????#???.#??
        return 0;
    }

    public function generatePart2($rows): string
    {
        return 0;
    }
}
