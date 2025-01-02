<?php

namespace App\DataFixtures\DayExamples;


class Examples2024
{
    public function day1Example1(): string
    {
        return <<<'EOT'
3   4
4   3
2   5
1   3
3   9
3   3
EOT;
    }

    public function day1Example2(): string
    {
        return $this->day1Example1();
    }

    public function day2Example1(): string
    {
        return <<<'EOT'
7 6 4 2 1
1 2 7 8 9
9 7 6 2 1
1 3 2 4 5
8 6 4 4 1
1 3 6 7 9
EOT;
    }

    public function day2Example2(): string
    {
        return $this->day2Example1();
    }

    public function day3Example1(): string
    {
        return <<<'EOT'
xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))
EOT;
    }

    public function day3Example2(): string
    {
        return <<<'EOT'
xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))
EOT;
    }

    public function day4Example1(): string
    {
        return <<<'EOT'
MMMSXXMASM
MSAMXMSMSA
AMXSXMAAMM
MSAMASMSMX
XMASAMXAMM
XXAMMXXAMA
SMSMSASXSS
SAXAMASAAA
MAMMMXMMMM
MXMXAXMASX
EOT;
    }

    public function day4Example2(): string
    {
        return $this->day4Example1();
    }

    public function day5Example1(): string
    {
        return <<<'EOD'
47|53
97|13
97|61
97|47
75|29
61|13
75|53
29|13
97|29
53|29
61|53
97|53
61|29
47|13
75|47
97|75
47|61
75|61
47|29
75|13
53|13

75,47,61,53,29
97,61,53,29,13
75,29,13
75,97,47,61,53
61,13,29
97,13,75,29,47
EOD;
    }

    public function day5Example2(): string
    {
        return $this->day5Example1();
    }

    public function day6Example1(): string
    {
        return <<<'EOD'
....#.....
.........#
..........
..#.......
.......#..
..........
.#..^.....
........#.
#.........
......#...
EOD;
    }

    public function day6Example2(): string
    {
        return $this->day6Example1();
    }

    public function day7Example1(): string
    {
        return <<<'EOD'
190: 10 19
3267: 81 40 27
83: 17 5
156: 15 6
7290: 6 8 6 15
161011: 16 10 13
192: 17 8 14
21037: 9 7 18 13
292: 11 6 16 20
EOD;
    }

    public function day7Example2(): string
    {
        return $this->day7Example1();
    }

    public function day8Example1(): string
    {
        return <<<'EOD'
............
........0...
.....0......
.......0....
....0.......
......A.....
............
............
........A...
.........A..
............
............
EOD;
    }

    public function day8Example2(): string
    {
        return $this->day8Example1();
    }

    public function day9Example1(): string
    {
        return '2333133121414131402';
    }

    public function day9Example2(): string
    {
        return $this->day9Example1();
    }

    public function day10Example1(): string
    {
        return <<<'EOD'
89010123
78121874
87430965
96549874
45678903
32019012
01329801
10456732
EOD;

    }

    public function day10Example2(): string
    {
        return $this->day10Example1();

    }

    public function day11Example1(): string
    {
        return '125 17';
    }

    public function day11Example2(): string
    {
        return $this->day11Example1();
    }

    public function day12Example1(): string
    {
        return <<<'EOD'
RRRRIICCFF
RRRRIICCCF
VVRRRCCFFF
VVRCCCJFFF
VVVVCJJCFE
VVIVCCJJEE
VVIIICJJEE
MIIIIIJJEE
MIIISIJEEE
MMMISSJEEE
EOD;
    }

    public function day12Example2(): string
    {
        return $this->day12Example1();
    }

    public function day13Example1(): string
    {
        return <<<EOD
Button A: X+94, Y+34
Button B: X+22, Y+67
Prize: X=8400, Y=5400

Button A: X+26, Y+66
Button B: X+67, Y+21
Prize: X=12748, Y=12176

Button A: X+17, Y+86
Button B: X+84, Y+37
Prize: X=7870, Y=6450

Button A: X+69, Y+23
Button B: X+27, Y+71
Prize: X=18641, Y=10279
EOD;

    }

    public function day13Example2(): string
    {
        return $this->day13Example1();
    }

    public function day14Example1(): string
    {
        return <<<'EOD'
p=0,4 v=3,-3
p=6,3 v=-1,-3
p=10,3 v=-1,2
p=2,0 v=2,-1
p=0,0 v=1,3
p=3,0 v=-2,-2
p=7,6 v=-1,-3
p=3,0 v=-1,-2
p=9,3 v=2,3
p=7,3 v=-1,2
p=2,4 v=2,-3
p=9,5 v=-3,-3
EOD;

    }

    public function day14Example2(): string
    {
        return '';
    }

    public function day15Example1(): string
    {
        return <<<'EOD'
##########
#..O..O.O#
#......O.#
#.OO..O.O#
#..O@..O.#
#O#..O...#
#O..O..O.#
#.OO.O.OO#
#....O...#
##########

<vv>^<v^>v>^vv^v>v<>v^v<v<^vv<<<^><<><>>v<vvv<>^v^>^<<<><<v<<<v^vv^v>^
vvv<<^>^v^^><<>>><>^<<><^vv^^<>vvv<>><^^v>^>vv<>v<<<<v<^v>^<^^>>>^<v<v
><>vv>v^v^<>><>>>><^^>vv>v<^^^>>v^v^<^^>v^^>v^<^v>v<>>v^v^<v>v^^<^^vv<
<<v<^>>^^^^>>>v^<>vvv^><v<<<>^^^vv^<vvv>^>v<^^^^v<>^>vvvv><>>v^<<^^^^^
^><^><>>><>^^<<^^v>>><^<v>^<vv>>v>>>^v><>^v><<<<v>>v<v<v>vvv>^<><<>^><
^>><>^v<><^vvv<^^<><v<<<<<><^v<<<><<<^^<v<^^^><^>>^<v^><<<^>>^v<v^v<v^
>^>>^v>vv>^<<^v<>><<><<v<<v><>v<^vv<<<>^^v^>^^>>><<^v>>v^v><^^>>^<>vv^
<><^^>^^^<><vvvvv^v<v<<>^v<v>v<<^><<><<><<<^^<<<^<<>><<><^^^>^^<>^>v<>
^^>vv<^v^v<vv>^<><v<^v>^^^>>>^^vvv^>vvv<>>>^<^>>>>>^<<^v>^vvv<>^<><<v>
v^^>>><<^^<>>^v^<v^vv<>v^<<>^<^v^v><^<<<><<^<v><v<>vv>>v><v^<vv<>v^<<^
EOD;

    }

    public function day15Example2(): string
    {
        return $this->day15Example1();
    }

    public function day16Example1(): string
    {
        return <<<'EOD'
###############
#.......#....E#
#.#.###.#.###.#
#.....#.#...#.#
#.###.#####.#.#
#.#.#.......#.#
#.#.#####.###.#
#...........#.#
###.#.#####.#.#
#...#.....#.#.#
#.#.#.###.#.#.#
#.....#...#.#.#
#.###.#.#.#.#.#
#S..#.....#...#
###############
EOD;
    }

    public function day16Example2(): string
    {
        return '';
    }

    public function day17Example1(): string
    {
        return <<<'EOD'
Register A: 729
Register B: 0
Register C: 0

Program: 0,1,5,4,3,0
EOD;
    }

    public function day17Example2(): string
    {
        return <<<'EOD'
Register A: 2024
Register B: 0
Register C: 0

Program: 0,3,5,4,3,0
EOD;
    }

    public function day18Example1(): string
    {
        return '';
    }

    public function day18Example2(): string
    {
        return '';
    }

    public function day19Example1(): string
    {
        return '';
    }

    public function day19Example2(): string
    {
        return '';
    }

    public function day20Example1(): string
    {
        return '';
    }

    public function day20Example2(): string
    {
        return '';
    }

    public function day21Example1(): string
    {
        return '';
    }

    public function day21Example2(): string
    {
        return '';
    }

    public function day22Example1(): string
    {
        return '';
    }

    public function day22Example2(): string
    {
        return '';
    }

    public function day23Example1(): string
    {
        return '';
    }

    public function day23Example2(): string
    {
        return '';
    }

    public function day24Example1(): string
    {
        return '';
    }

    public function day24Example2(): string
    {
        return '';
    }

    public function day25Example1(): string
    {
        return <<<EOD
#####
.####
.####
.####
.#.#.
.#...
.....

#####
##.##
.#.##
...##
...#.
...#.
.....

.....
#....
#....
#...#
#.#.#
#.###
#####

.....
.....
#.#..
###..
###.#
###.#
#####

.....
.....
.....
#....
#.#..
#.#.#
#####
EOD;
    }

    public function day25Example2(): string
    {
        return $this->day25Example1();
    }
}
