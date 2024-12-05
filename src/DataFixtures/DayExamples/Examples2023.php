<?php

namespace App\DataFixtures\DayExamples;


class Examples2023
{
    public function day1Example1(): string
    {
        return <<<'EOT'
1abc2
pqr3stu8vwx
a1b2c3d4e5f
treb7uchet
EOT;
    }

    public function day1Example2(): string
    {
        return <<<'EOT'
two1nine
eightwothree
abcone2threexyz
xtwone3four
4nineeightseven2
zoneight234
7pqrstsixteen
EOT;
    }

    public function day2Example1(): string
    {
        return <<<'EOT'
Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green
EOT;
    }

    public function day2Example2(): string
    {
        return $this->day2Example1();
    }

    public function day3Example1(): string
    {
        return <<<'EOT'
467..114..
...*......
..35..633.
......#...
617*......
.....+.58.
..592.....
......755.
...$.*....
.664.598..
EOT;
    }

    public function day3Example2(): string
    {
        return $this->day3Example1();
    }

    public function day4Example1(): string
    {
        return <<<'EOT'
Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53
Card 2: 13 32 20 16 61 | 61 30 68 82 17 32 24 19
Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1
Card 4: 41 92 73 84 69 | 59 84 76 51 58  5 54 83
Card 5: 87 83 26 28 32 | 88 30 70 12 93 22 82 36
Card 6: 31 18 13 56 72 | 74 77 10 23 35 67 36 11
EOT;
    }

    public function day4Example2(): string
    {
        return $this->day4Example1();
    }

    public function day5Example1(): string
    {
        return <<<'EOT'
seeds: 79 14 55 13

seed-to-soil map:
50 98 2
52 50 48

soil-to-fertilizer map:
0 15 37
37 52 2
39 0 15

fertilizer-to-water map:
49 53 8
0 11 42
42 0 7
57 7 4

water-to-light map:
88 18 7
18 25 70

light-to-temperature map:
45 77 23
81 45 19
68 64 13

temperature-to-humidity map:
0 69 1
1 0 69

humidity-to-location map:
60 56 37
56 93 4
EOT;
    }

    public function day5Example2(): string
    {
        return $this->day5Example1();
    }

    public function day6Example1(): string
    {
        return <<<'EOT'
Time:      7  15   30
Distance:  9  40  200
EOT;
    }

    public function day6Example2(): string
    {
        return $this->day6Example1();
    }

    public function day7Example1(): string
    {
        return <<<'EOT'
32T3K 765
T55J5 684
KK677 28
KTJJT 220
QQQJA 483
EOT;
    }

    public function day7Example2(): string
    {
        return $this->day7Example1();
    }

    public function day8Example1(): string
    {
        return <<<'EOT'
RL

AAA = (BBB, CCC)
BBB = (DDD, EEE)
CCC = (ZZZ, GGG)
DDD = (DDD, DDD)
EEE = (EEE, EEE)
GGG = (GGG, GGG)
ZZZ = (ZZZ, ZZZ)
EOT;
    }

    public function day8Example2(): string
    {
        return <<<'EOT'
LR

11A = (11B, XXX)
11B = (XXX, 11Z)
11Z = (11B, XXX)
22A = (22B, XXX)
22B = (22C, 22C)
22C = (22Z, 22Z)
22Z = (22B, 22B)
XXX = (XXX, XXX)
EOT;
    }

    public function day9Example1(): string
    {
        return <<<'EOT'
0 3 6 9 12 15
1 3 6 10 15 21
10 13 16 21 30 45
EOT;
    }

    public function day9Example2(): string
    {
        return $this->day9Example1();
    }

    public function day10Example1(): string
    {
        return <<<'EOT'
..F7.
.FJ|.
SJ.L7
|F--J
LJ...
EOT;
    }

    public function day10Example2(): string
    {
        return <<<'EOT'
FF7FSF7F7F7F7F7F---7
L|LJ||||||||||||F--J
FL-7LJLJ||||||LJL-77
F--JF--7||LJLJ7F7FJ-
L---JF-JLJ.||-FJLJJ7
|F|F-JF---7F7-L7L|7|
|FFJF7L7F-JF7|JL---7
7-L-JL7||F7|L7F-7F7|
L.L7LFJ|||||FJL7||LJ
L7JLJL-JLJLJL--JLJ.L
EOT;
    }

    public function day11Example1(): string
    {
        return <<<'EOT'
...#......
.......#..
#.........
..........
......#...
.#........
.........#
..........
.......#..
#...#.....
EOT;
    }

    public function day11Example2(): string
    {
        return $this->day11Example1();
    }

    public function day12Example1(): string
    {
        return <<<'EOT'
???.### 1,1,3
.??..??...?##. 1,1,3
?#?#?#?#?#?#?#? 1,3,1,6
????.#...#... 4,1,1
????.######..#####. 1,6,5
?###???????? 3,2,1
EOT;
    }

    public function day12Example2(): string
    {
        return <<<'EOT'
#.#.### 1,1,3
.#...#....###. 1,1,3
.#.###.#.###### 1,3,1,6
####.#...#... 4,1,1
#....######..#####. 1,6,5
.###.##....# 3,2,1
EOT;
    }

    public function day13Example1(): string
    {
        return <<<'EOT'
#.##..##.
..#.##.#.
##......#
##......#
..#.##.#.
..##..##.
#.#.##.#.

#...##..#
#....#..#
..##..###
#####.##.
#####.##.
..##..###
#....#..#
EOT;
    }

    public function day13Example2(): string
    {
        return $this->day13Example1();
    }

    public function day14Example1(): string
    {
        return <<<'EOT'
O....#....
O.OO#....#
.....##...
OO.#O....O
.O.....O#.
O.#..O.#.#
..O..#O..O
.......O..
#....###..
#OO..#....
EOT;
    }

    public function day14Example2(): string
    {
        return $this->day14Example1();
    }

    public function day15Example1(): string
    {
        return 'rn=1,cm-,qp=3,cm=2,qp-,pc=4,ot=9,ab=5,pc-,pc=6,ot=7';
    }

    public function day15Example2(): string
    {
        return $this->day15Example1();
    }

    public function day16Example1(): string
    {
        return <<<'EOT'
.|...\....
|.-.\.....
.....|-...
........|.
..........
.........\
..../.\\..
.-.-/..|..
.|....-|.\
..//.|....
EOT;
    }

    public function day16Example2(): string
    {
        return $this->day16Example1();
    }

    public function day17Example1(): string
    {
        return <<<'EOT'
2413432311323
3215453535623
3255245654254
3446585845452
4546657867536
1438598798454
4457876987766
3637877979653
4654967986887
4564679986453
1224686865563
2546548887735
4322674655533
EOT;
    }

    public function day17Example2(): string
    {
        return '';
    }

    public function day18Example1(): string
    {
        return <<<'EOT'
R 6 (#70c710)
D 5 (#0dc571)
L 2 (#5713f0)
D 2 (#d2c081)
R 2 (#59c680)
D 2 (#411b91)
L 5 (#8ceee2)
U 2 (#caa173)
L 1 (#1b58a2)
U 2 (#caa171)
R 2 (#7807d2)
U 3 (#a77fa3)
L 2 (#015232)
U 2 (#7a21e3)
EOT;
    }

    public function day18Example2(): string
    {
        return '';
    }

    public function day19Example1(): string
    {
        return <<<'EOT'
px{a<2006:qkq,m>2090:A,rfg}
pv{a>1716:R,A}
lnx{m>1548:A,A}
rfg{s<537:gd,x>2440:R,A}
qs{s>3448:A,lnx}
qkq{x<1416:A,crn}
crn{x>2662:A,R}
in{s<1351:px,qqz}
qqz{s>2770:qs,m<1801:hdj,R}
gd{a>3333:R,R}
hdj{m>838:A,pv}

{x=787,m=2655,a=1222,s=2876}
{x=1679,m=44,a=2067,s=496}
{x=2036,m=264,a=79,s=2244}
{x=2461,m=1339,a=466,s=291}
{x=2127,m=1623,a=2188,s=1013}
EOT;
    }

    public function day19Example2(): string
    {
        return $this->day19Example1();
    }

    public function day20Example1(): string
    {
        return <<<'EOT'
broadcaster -> a, b, c
%a -> b
%b -> c
%c -> inv
&inv -> a
EOT;
    }

    public function day20Example2(): string
    {
        return $this->day20Example1();
    }

    public function day21Example1(): string
    {
        return <<<'EOT'
...........
.....###.#.
.###.##..#.
..#.#...#..
....#.#....
.##..S####.
.##..#...#.
.......##..
.##.#.####.
.##..##.##.
...........

EOT;
    }

    public function day21Example2(): string
    {
        return '';
    }

    public function day22Example1(): string
    {
        return <<<'EOT'
1,0,1~1,2,1
0,0,2~2,0,2
0,2,3~2,2,3
0,0,4~0,2,4
2,0,5~2,2,5
0,1,6~2,1,6
1,1,8~1,1,9
EOT;
    }

    public function day22Example2(): string
    {
        return '';
    }

    public function day23Example1(): string
    {
        return <<<'EOT'
#.#####################
#.......#########...###
#######.#########.#.###
###.....#.>.>.###.#.###
###v#####.#v#.###.#.###
###.>...#.#.#.....#...#
###v###.#.#.#########.#
###...#.#.#.......#...#
#####.#.#.#######.#.###
#.....#.#.#.......#...#
#.#####.#.#.#########v#
#.#...#...#...###...>.#
#.#.#v#######v###.###v#
#...#.>.#...>.>.#.###.#
#####v#.#.###v#.#.###.#
#.....#...#...#.#.#...#
#.#########.###.#.#.###
#...###...#...#...#.###
###.###.#.###v#####v###
#...#...#.#.>.>.#.>.###
#.###.###.#.###.#.#v###
#.....###...###...#...#
#####################.#
EOT;
    }

    public function day23Example2(): string
    {
        return '';
    }

    public function day24Example1(): string
    {
        return <<<'EOT'
19, 13, 30 @ -2,  1, -2
18, 19, 22 @ -1, -1, -2
20, 25, 34 @ -2, -2, -4
12, 31, 28 @ -1, -2, -1
20, 19, 15 @  1, -5, -3
EOT;
    }

    public function day24Example2(): string
    {
        return '';
    }

    public function day25Example1(): string
    {
        return <<<'EOT'
jqt: rhn xhk nvd
rsh: frs pzl lsr
xhk: hfx
cmg: qnr nvd lhk bvb
rhn: xhk bvb hfx
bvb: xhk hfx
pzl: lsr hfx nvd
qnr: nvd
ntq: jqt hfx bvb xhk
nvd: lhk
lsr: lhk
rzs: qnr cmg lsr rsh
frs: qnr lhk lsr
EOT;
    }

    public function day25Example2(): string
    {
        return '';
    }
}