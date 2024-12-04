<?php

namespace App\DataFixtures\DayExamples;

class DayExamples2015
{
    public function __construct(
        private readonly Examples2015 $examples
    )
    {
    }

    public function getDay1Examples(): \Iterator
    {
        yield $this->examples->day1Example1();
        yield $this->examples->day1Example2();
    }

    public function getDay2Examples(): \Iterator
    {
        yield $this->examples->day2Example1();
        yield $this->examples->day2Example2();
    }

    public function getDay3Examples(): \Iterator
    {
        yield $this->examples->day3Example1();
        yield $this->examples->day3Example2();
    }

    public function getDay4Examples(): \Iterator
    {
        yield $this->examples->day4Example1();
        yield $this->examples->day4Example2();
    }

    public function getDay5Examples(): \Iterator
    {
        yield $this->examples->day5Example1();
        yield $this->examples->day5Example2();
    }

    public function getDay6Examples(): \Iterator
    {
        yield $this->examples->day6Example1();
        yield $this->examples->day6Example2();
    }

    public function getDay7Examples(): \Iterator
    {
        yield $this->examples->day7Example1();
        yield $this->examples->day7Example2();
    }

    public function getDay8Examples(): \Iterator
    {
        yield $this->examples->day8Example1();
        yield $this->examples->day8Example2();
    }

    public function getDay9Examples(): \Iterator
    {
        yield $this->examples->day9Example1();
        yield $this->examples->day9Example2();
    }

    public function getDay10Examples(): \Iterator
    {
        yield $this->examples->day10Example1();
        yield $this->examples->day10Example2();
    }

    public function getDay11Examples(): \Iterator
    {
        yield $this->examples->day11Example1();
        yield $this->examples->day11Example2();
    }

    public function getDay12Examples(): \Iterator
    {
        yield $this->examples->day12Example1();
        yield $this->examples->day12Example2();
    }

    public function getDay13Examples(): \Iterator
    {
        yield $this->examples->day13Example1();
        yield $this->examples->day13Example2();
    }

    public function getDay14Examples(): \Iterator
    {
        yield $this->examples->day14Example1();
        yield $this->examples->day14Example2();
    }

    public function getDay15Examples(): \Iterator
    {
        yield $this->examples->day15Example1();
        yield $this->examples->day15Example2();
    }

    public function getDay16Examples(): \Iterator
    {
        yield $this->examples->day16Example1();
        yield $this->examples->day16Example2();
    }

    public function getDay17Examples(): \Iterator
    {
        yield $this->examples->day17Example1();
        yield $this->examples->day17Example2();
    }

    public function getDay18Examples(): \Iterator
    {
        yield $this->examples->day18Example1();
        yield $this->examples->day18Example2();
    }

    public function getDay19Examples(): \Iterator
    {
        yield $this->examples->day19Example1();
        yield $this->examples->day19Example2();
    }

    public function getDay20Examples(): \Iterator
    {
        yield $this->examples->day20Example1();
        yield $this->examples->day20Example2();
    }

    public function getDay21Examples(): \Iterator
    {
        yield $this->examples->day21Example1();
        yield $this->examples->day21Example2();
    }

    public function getDay22Examples(): \Iterator
    {
        yield $this->examples->day22Example1();
        yield $this->examples->day22Example2();
    }

    public function getDay23Examples(): \Iterator
    {
        yield $this->examples->day23Example1();
        yield $this->examples->day23Example2();
    }

    public function getDay24Examples(): \Iterator
    {
        yield $this->examples->day24Example1();
        yield $this->examples->day24Example2();
    }

    public function getDay25Examples(): \Iterator
    {
        yield $this->examples->day25Example1();
        yield $this->examples->day25Example2();
    }
}