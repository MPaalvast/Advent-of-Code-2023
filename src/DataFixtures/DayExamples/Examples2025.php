<?php

namespace App\DataFixtures\DayExamples;

class Examples2025
{
    public function day1ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
L68
L30
R48
L5
R60
L55
L1
L99
R14
L82
EOT, 'result' => 3],
        ];
    }

    public function day1ExamplesPart2(): array
    {
        $data = $this->day1ExamplesPart1();
        $data[0]['result'] = 6;

        return $data;
    }

    public function day2ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
11-22,95-115,998-1012,1188511880-1188511890,222220-222224,
1698522-1698528,446443-446449,38593856-38593862,565653-565659,
824824821-824824827,2121212118-2121212124
EOT, 'result' => 1227775554]
        ];
    }

    public function day2ExamplesPart2(): array
    {
        $data = $this->day2ExamplesPart1();
        $data[0]['result'] = 4174379265;

        return $data;
    }

    public function day3ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
987654321111111
811111111111119
234234234234278
818181911112111
EOT , 'result' => 357]
        ];
    }

    public function day3ExamplesPart2(): array
    {
        $data = $this->day3ExamplesPart1();
        $data[0]['result'] = 3121910778619;

        return $data;
    }

    public function day4ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
..@@.@@@@.
@@@.@.@.@@
@@@@@.@.@@
@.@@@@..@.
@@.@@@@.@@
.@@@@@@@.@
.@.@.@.@@@
@.@@@.@@@@
.@@@@@@@@.
@.@.@@@.@.
EOD, 'result' => 13]
        ];
    }

    public function day4ExamplesPart2(): array
    {
        $data = $this->day4ExamplesPart1();
        $data[0]['result'] = 43;

        return $data;
    }

    public function day5ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
3-5
10-14
16-20
12-18

1
5
8
11
17
32
EOD, 'result' => 3]
        ];
    }

    public function day5ExamplesPart2(): array
    {
        $data = $this->day5ExamplesPart1();
        $data[0]['result'] = 14;

        return $data;
    }

    public function day6ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
123 328  51 64 
 45 64  387 23 
  6 98  215 314
*   +   *   + 
EOD, 'result' => 4277556]
        ];
    }

    public function day6ExamplesPart2(): array
    {
        $data = $this->day6ExamplesPart1();
        $data[0]['result'] = 3263827;

        return $data;
    }

    public function day7ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
.......S.......
...............
.......^.......
...............
......^.^......
...............
.....^.^.^.....
...............
....^.^...^....
...............
...^.^...^.^...
...............
..^...^.....^..
...............
.^.^.^.^.^...^.
...............
EOD, 'result' => 21]
        ];
    }

    public function day7ExamplesPart2(): array
    {
        $data = $this->day7ExamplesPart1();
        $data[0]['result'] = 40;

        return $data;
    }

    public function day8ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
162,817,812
57,618,57
906,360,560
592,479,940
352,342,300
466,668,158
542,29,236
431,825,988
739,650,466
52,470,668
216,146,977
819,987,18
117,168,530
805,96,715
346,949,466
970,615,88
941,993,340
862,61,35
984,92,344
425,690,689
EOD, 'result' => 40]
        ];
    }

    public function day8ExamplesPart2(): array
    {
        $data = $this->day8ExamplesPart1();
        $data[0]['result'] = 25272;

        return $data;
    }

    public function day9ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
7,1
11,1
11,7
9,7
9,5
2,5
2,3
7,3
EOD, 'result' => 50]
        ];
    }

    public function day9ExamplesPart2(): array
    {
        $data = $this->day9ExamplesPart1();
        $data[0]['result'] = 24;

        return $data;
    }

    public function day10ExamplesPart1(): array
    {
        return [
            ['input' => '', 'result' => 0]
        ];
    }

    public function day10ExamplesPart2(): array
    {
        return $this->day10ExamplesPart1();
    }

    public function day11ExamplesPart1(): array
    {
        return [
            ['input' => '', 'result' => 0]
        ];
    }

    public function day11ExamplesPart2(): array
    {
        return $this->day11ExamplesPart1();
    }

    public function day12ExamplesPart1(): array
    {
        return [
            ['input' => '', 'result' => 0]
        ];
    }

    public function day12ExamplesPart2(): array
    {
        return $this->day12ExamplesPart1();
    }
}