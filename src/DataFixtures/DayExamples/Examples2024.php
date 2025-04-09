<?php

namespace App\DataFixtures\DayExamples;


class Examples2024
{
    public function day1ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
3   4
4   3
2   5
1   3
3   9
3   3
EOT, 'result' => 11],
        ];
    }

    public function day1ExamplesPart2(): array
    {
        $data = $this->day1ExamplesPart1();
        $data[0]['result'] = 31;

        return $data;
    }

    public function day2ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
7 6 4 2 1
1 2 7 8 9
9 7 6 2 1
1 3 2 4 5
8 6 4 4 1
1 3 6 7 9
EOT, 'result' => 2],
        ];
    }

    public function day2ExamplesPart2(): array
    {
        $data = $this->day2ExamplesPart1();
        $data[0]['result'] = 4;

        return $data;
    }

    public function day3ExamplesPart1(): array
    {
        return [
            ['input' => 'xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))', 'result' => 161],
        ];
    }

    public function day3ExamplesPart2(): array
    {
        return [
            ['input' => "xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))", 'result' => 48],
        ];
    }

    public function day4ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
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
EOT, 'result' => 18],
        ];
    }

    public function day4ExamplesPart2(): array
    {
        $data = $this->day4ExamplesPart1();
        $data[0]['result'] = 9;

        return $data;
    }

    public function day5ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
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
EOT, 'result' => 143],
        ];
    }

    public function day5ExamplesPart2(): array
    {
        $data = $this->day4ExamplesPart1();
        $data[0]['result'] = 123;

        return $data;
    }

    public function day6ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
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
EOT, 'result' => 41],
        ];
    }

    public function day6ExamplesPart2(): array
    {
        $data = $this->day6ExamplesPart1();
        $data[0]['result'] = 6;

        return $data;
    }

    public function day7ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
190: 10 19
3267: 81 40 27
83: 17 5
156: 15 6
7290: 6 8 6 15
161011: 16 10 13
192: 17 8 14
21037: 9 7 18 13
292: 11 6 16 20
EOT, 'result' => 3749],
        ];
    }

    public function day7ExamplesPart2(): array
    {
        $data = $this->day7ExamplesPart1();
        $data[0]['result'] = 11387;

        return $data;
    }

    public function day8ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
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
EOT, 'result' => 14],
        ];
    }

    public function day8ExamplesPart2(): array
    {
        $data = $this->day8ExamplesPart1();
        $data[0]['result'] = 34;

        return $data;
    }

    public function day9ExamplesPart1(): array
    {
        return [
            ['input' => '2333133121414131402', 'result' => 1928],
        ];
    }

    public function day9ExamplesPart2(): array
    {
        $data = $this->day9ExamplesPart1();
        $data[0]['result'] = 2858;

        return $data;
    }

    public function day10ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
...0...
...1...
...2...
6543456
7.....7
8.....8
9.....9
EOT, 'result' => 2],
            ['input' => <<<'EOT'
..90..9
...1.98
...2..7
6543456
765.987
876....
987....
EOT, 'result' => 4],
            ['input' => <<<'EOT'
89010123
78121874
87430965
96549874
45678903
32019012
01329801
10456732
EOT, 'result' => 36],
        ];
    }

    public function day10ExamplesPart2(): array
    {
        return [
            ['input' => <<<'EOT'
.....0.
..4321.
..5..2.
..6543.
..7..4.
..8765.
..9....
EOT, 'result' => 3],
            ['input' => <<<'EOT'
..90..9
...1.98
...2..7
6543456
765.987
876....
987....
EOT, 'result' => 13],
            ['input' => <<<'EOT'
012345
123456
234567
345678
4.6789
56789.
EOT, 'result' => 227],
            ['input' => <<<'EOT'
89010123
78121874
87430965
96549874
45678903
32019012
01329801
10456732
EOT, 'result' => 81],
        ];
    }

    public function day11ExamplesPart1(): array
    {
        return [
            ['input' => '125 17', 'result' => 55312],
        ];
    }

    public function day11ExamplesPart2(): array
    {
        return $this->day11ExamplesPart1();
    }

    public function day12ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
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
EOT, 'result' => 1930],
            ['input' => <<<'EOT'
OOOOO
OXOXO
OOOOO
OXOXO
OOOOO
EOT, 'result' => 772],
        ];
    }

    public function day12ExamplesPart2(): array
    {
        return [
            ['input' => <<<'EOT'
AAAA
BBCD
BBCC
EEEC
EOT, 'result' => 80],
            ['input' => <<<'EOT'
OOOOO
OXOXO
OOOOO
OXOXO
OOOOO
EOT, 'result' => 436],
            ['input' => <<<'EOT'
EEEEE
EXXXX
EEEEE
EXXXX
EEEEE
EOT, 'result' => 236],
            ['input' => <<<'EOT'
AAAAAA
AAABBA
AAABBA
ABBAAA
ABBAAA
AAAAAA
EOT, 'result' => 368],
        ];
    }

    public function day13ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
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
EOT, 'result' => 480],
        ];
    }

    public function day13ExamplesPart2(): array
    {
        return [];
    }

    public function day14ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
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
EOT, 'result' => 12],
        ];
    }

    public function day14ExamplesPart2(): array
    {
        return [];
    }

    public function day15ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
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
EOT, 'result' => 2028],
        ];
    }

    public function day15ExamplesPart2(): array
    {
        $data = $this->day15ExamplesPart1();
        $data[0]['result'] = 9021;

        return $data;
    }

    public function day16ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
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
EOT, 'result' => 11048],
        ];
    }

    public function day16ExamplesPart2(): array
    {
        return [];
    }

    public function day17ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
Register A: 729
Register B: 0
Register C: 0

Program: 0,1,5,4,3,0
EOT, 'result' => '4,6,3,5,6,3,5,2,1,0'],
        ];
    }

    public function day17ExamplesPart2(): array
    {
        return [
            ['input' => <<<'EOT'
Register A: 2024
Register B: 0
Register C: 0

Program: 0,3,5,4,3,0
EOT, 'result' => 117440],
        ];
    }

    public function day18ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
5,4
4,2
4,5
3,0
2,1
6,3
2,4
1,5
0,6
3,3
2,6
5,1
1,2
5,5
2,5
6,5
1,4
0,4
6,4
1,1
6,1
1,0
0,5
1,6
2,0
EOT, 'result' => 22],
        ];
    }

    public function day18ExamplesPart2(): array
    {
        $data = $this->day18ExamplesPart1();
        $data[0]['result'] = '6,1';

        return $data;
    }

    public function day19ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
r, wr, b, g, bwu, rb, gb, br

brwrr
bggr
gbbr
rrbgbr
ubwu
bwurrg
brgr
bbrgwb
EOT, 'result' => 22],
        ];
    }

    public function day19ExamplesPart2(): array
    {
        return [];
    }

    public function day20ExamplesPart1(): array
    {
        return [];
    }

    public function day20ExamplesPart2(): array
    {
        return [];
    }

    public function day21ExamplesPart1(): array
    {
        return [];
    }

    public function day21ExamplesPart2(): array
    {
        return [];
    }

    public function day22ExamplesPart1(): array
    {
        return [];
    }

    public function day22ExamplesPart2(): array
    {
        return [];
    }

    public function day23ExamplesPart1(): array
    {
        return [];
    }

    public function day23ExamplesPart2(): array
    {
        return [];
    }

    public function day24ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
x00: 1
x01: 1
x02: 1
y00: 0
y01: 1
y02: 0

x00 AND y00 -> z00
x01 XOR y01 -> z01
x02 OR y02 -> z02
EOT, 'result' => 4],
            ['input' => <<<'EOT'
x00: 1
x01: 0
x02: 1
x03: 1
x04: 0
y00: 1
y01: 1
y02: 1
y03: 1
y04: 1

ntg XOR fgs -> mjb
y02 OR x01 -> tnw
kwq OR kpj -> z05
x00 OR x03 -> fst
tgd XOR rvg -> z01
vdt OR tnw -> bfw
bfw AND frj -> z10
ffh OR nrd -> bqk
y00 AND y03 -> djm
y03 OR y00 -> psh
bqk OR frj -> z08
tnw OR fst -> frj
gnj AND tgd -> z11
bfw XOR mjb -> z00
x03 OR x00 -> vdt
gnj AND wpb -> z02
x04 AND y00 -> kjc
djm OR pbm -> qhw
nrd AND vdt -> hwm
kjc AND fst -> rvg
y04 OR y02 -> fgs
y01 AND x02 -> pbm
ntg OR kjc -> kwq
psh XOR fgs -> tgd
qhw XOR tgd -> z09
pbm OR djm -> kpj
x03 XOR y03 -> ffh
x00 XOR y04 -> ntg
bfw OR bqk -> z06
nrd XOR fgs -> wpb
frj XOR qhw -> z04
bqk OR frj -> z07
y03 OR x01 -> nrd
hwm AND bqk -> z03
tgd XOR rvg -> z12
tnw OR pbm -> gnj
EOT, 'result' => 2024],
        ];
    }

    public function day24ExamplesPart2(): array
    {
        return [];
    }

    public function day25ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOT'
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
EOT, 'result' => 3],
        ];
    }

    public function day25ExamplesPart2(): array
    {
        return [];
    }
}
