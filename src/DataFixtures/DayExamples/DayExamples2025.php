<?php

namespace App\DataFixtures\DayExamples;

class DayExamples2025
{
    public function __construct(
        private readonly Examples2025 $examples
    )
    {
    }

    public function getDay1Examples(): \Iterator
    {
        yield $this->examples->day1ExamplesPart1();
        yield $this->examples->day1ExamplesPart2();
    }

    public function getDay2Examples(): \Iterator
    {
        yield $this->examples->day2ExamplesPart1();
        yield $this->examples->day2ExamplesPart2();
    }

    public function getDay3Examples(): \Iterator
    {
        yield $this->examples->day3ExamplesPart1();
        yield $this->examples->day3ExamplesPart2();
    }

    public function getDay4Examples(): \Iterator
    {
        yield $this->examples->day4ExamplesPart1();
        yield $this->examples->day4ExamplesPart2();
    }

    public function getDay5Examples(): \Iterator
    {
        yield $this->examples->day5ExamplesPart1();
        yield $this->examples->day5ExamplesPart2();
    }

    public function getDay6Examples(): \Iterator
    {
        yield $this->examples->day6ExamplesPart1();
        yield $this->examples->day6ExamplesPart2();
    }

    public function getDay7Examples(): \Iterator
    {
        yield $this->examples->day7ExamplesPart1();
        yield $this->examples->day7ExamplesPart2();
    }

    public function getDay8Examples(): \Iterator
    {
        yield $this->examples->day8ExamplesPart1();
        yield $this->examples->day8ExamplesPart2();
    }

    public function getDay9Examples(): \Iterator
    {
        yield $this->examples->day9ExamplesPart1();
        yield $this->examples->day9ExamplesPart2();
    }

    public function getDay10Examples(): \Iterator
    {
        yield $this->examples->day10ExamplesPart1();
        yield $this->examples->day10ExamplesPart2();
    }

    public function getDay11Examples(): \Iterator
    {
        yield $this->examples->day11ExamplesPart1();
        yield $this->examples->day11ExamplesPart2();
    }

    public function getDay12Examples(): \Iterator
    {
        yield $this->examples->day12ExamplesPart1();
        yield $this->examples->day12ExamplesPart2();
    }
}