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
        return $this->day3ExamplesPart1();
    }

    public function day4ExamplesPart1(): array
    {
        return [
            ['input' => '', 'result' => 0]
        ];
    }

    public function day4ExamplesPart2(): array
    {
        return $this->day4ExamplesPart1();
    }

    public function day5ExamplesPart1(): array
    {
        return [
            ['input' => '', 'result' => 0]
        ];
    }

    public function day5ExamplesPart2(): array
    {
        return $this->day5ExamplesPart1();
    }

    public function day6ExamplesPart1(): array
    {
        return [
            ['input' => '', 'result' => 0]
        ];
    }

    public function day6ExamplesPart2(): array
    {
        return $this->day6ExamplesPart1();
    }

    public function day7ExamplesPart1(): array
    {
        return [
            ['input' => '', 'result' => 0]
        ];
    }

    public function day7ExamplesPart2(): array
    {
        return $this->day7ExamplesPart1();
    }

    public function day8ExamplesPart1(): array
    {
        return [
            ['input' => '', 'result' => 0]
        ];
    }

    public function day8ExamplesPart2(): array
    {
        return $this->day8ExamplesPart1();
    }

    public function day9ExamplesPart1(): array
    {
        return [
            ['input' => '', 'result' => 0]
        ];
    }

    public function day9ExamplesPart2(): array
    {
        return $this->day9ExamplesPart1();
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