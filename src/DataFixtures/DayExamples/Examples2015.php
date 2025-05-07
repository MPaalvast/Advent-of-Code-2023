<?php

namespace App\DataFixtures\DayExamples;


class Examples2015
{
    public function day1ExamplesPart1(): array
    {
        return [
            ['input' => '(())', 'result' => 0],
            ['input' => '()()', 'result' => 0],
            ['input' => '(((', 'result' => 3],
            ['input' => '(()(()(', 'result' => 3],
            ['input' => '))(((((', 'result' => 3],
            ['input' => '())', 'result' => -1],
            ['input' => '))(', 'result' => -1],
            ['input' => ')))', 'result' => -3],
            ['input' => ')())())', 'result' => -3],
        ];
    }

    public function day1ExamplesPart2(): array
    {
        return [
            ['input' => ')', 'result' => 1],
            ['input' => '()())', 'result' => 5],
        ];
    }

    public function day2ExamplesPart1(): array
    {
        return [
            ['input' => '2x3x4', 'result' => 58],
            ['input' => '1x1x10', 'result' => 43],
        ];
    }

    public function day2ExamplesPart2(): array
    {
        return [
            ['input' => '2x3x4', 'result' => 34],
            ['input' => '1x1x10', 'result' => 14],
        ];
    }

    public function day3ExamplesPart1(): array
    {
        return [
            ['input' => '>', 'result' => 2],
            ['input' => '^>v<', 'result' => 4],
            ['input' => '^v^v^v^v^v', 'result' => 2],
        ];
    }

    public function day3ExamplesPart2(): array
    {
        return [
            ['input' => '^v', 'result' => 3],
            ['input' => '^>v<', 'result' => 3],
            ['input' => '^v^v^v^v^v', 'result' => 3],
        ];
    }

    public function day4ExamplesPart1(): array
    {
        return [
            ['input' => 'abcdef', 'result' => 609043],
            ['input' => 'pqrstuv', 'result' => 1048970],
            ['input' => 'yzbqklnj', 'result' => 282749],
        ];
    }

    public function day4ExamplesPart2(): array
    {
        return [
            ['input' => 'yzbqklnj', 'result' => 9962624],
        ];
    }

    public function day5ExamplesPart1(): array
    {
        return [
            ['input' => 'ugknbfddgicrmopn', 'result' => 1],
            ['input' => 'aaa', 'result' => 1],
            ['input' => 'jchzalrnumimnmhp', 'result' => 0],
            ['input' => 'haegwjzuvuyypxyu', 'result' => 0],
            ['input' => 'dvszwmarrgswjxmb', 'result' => 0],
            ['input' => <<<'EOD'
ugknbfddgicrmopn
aaa
jchzalrnumimnmhp
haegwjzuvuyypxyu
dvszwmarrgswjxmb
EOD
, 'result' => 2],
        ];
    }

    public function day5ExamplesPart2(): array
    {
        return [
            ['input' => 'qjhvhtzxzqqjkmpb', 'result' => 1],
            ['input' => 'xxyxx', 'result' => 1],
            ['input' => 'uurcxstgmygtbstg', 'result' => 0],
            ['input' => 'ieodomkazucvgmuy', 'result' => 0],
            ['input' => <<<'EOD'
qjhvhtzxzqqjkmpb
xxyxx
uurcxstgmygtbstg
ieodomkazucvgmuy
EOD
                , 'result' => 2],
        ];
    }

    public function day6ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
turn on 0,0 through 999,999
toggle 0,0 through 999,0
turn off 499,499 through 500,500
EOD
                , 'result' => 998996],
        ];
    }

    public function day6ExamplesPart2(): array
    {
        return [
            ['input' => 'toggle 0,0 through 999,999', 'result' => 2000000],
            ['input' => 'turn on 0,0 through 0,0', 'result' => 1],
            ['input' => <<<'EOD'
turn on 0,0 through 999,999
toggle 0,0 through 999,0
turn off 499,499 through 500,500
EOD
                , 'result' => 1001996],
        ];
    }

    public function day7ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
123 -> x
456 -> y
x AND y -> d
x OR y -> e
x LSHIFT 2 -> f
y RSHIFT 2 -> g
NOT x -> h
NOT y -> i
EOD
                , 'result' => 72],
        ];
    }

    public function day7ExamplesPart2(): array
    {
        return [
            ['input' => <<<'EOD'
af AND ah -> ai
NOT lk -> ll
hz RSHIFT 1 -> is
NOT go -> gp
du OR dt -> dv
x RSHIFT 5 -> aa
at OR az -> ba
eo LSHIFT 15 -> es
ci OR ct -> cu
b RSHIFT 5 -> f
fm OR fn -> fo
NOT ag -> ah
v OR w -> x
g AND i -> j
an LSHIFT 15 -> ar
1 AND cx -> cy
jq AND jw -> jy
iu RSHIFT 5 -> ix
gl AND gm -> go
NOT bw -> bx
jp RSHIFT 3 -> jr
hg AND hh -> hj
bv AND bx -> by
er OR es -> et
kl OR kr -> ks
et RSHIFT 1 -> fm
e AND f -> h
u LSHIFT 1 -> ao
he RSHIFT 1 -> hx
eg AND ei -> ej
bo AND bu -> bw
dz OR ef -> eg
dy RSHIFT 3 -> ea
gl OR gm -> gn
da LSHIFT 1 -> du
au OR av -> aw
gj OR gu -> gv
eu OR fa -> fb
lg OR lm -> ln
e OR f -> g
NOT dm -> dn
NOT l -> m
aq OR ar -> as
gj RSHIFT 5 -> gm
hm AND ho -> hp
ge LSHIFT 15 -> gi
jp RSHIFT 1 -> ki
hg OR hh -> hi
lc LSHIFT 1 -> lw
km OR kn -> ko
eq LSHIFT 1 -> fk
1 AND am -> an
gj RSHIFT 1 -> hc
aj AND al -> am
gj AND gu -> gw
ko AND kq -> kr
ha OR gz -> hb
bn OR by -> bz
iv OR jb -> jc
NOT ac -> ad
bo OR bu -> bv
d AND j -> l
bk LSHIFT 1 -> ce
de OR dk -> dl
dd RSHIFT 1 -> dw
hz AND ik -> im
NOT jd -> je
fo RSHIFT 2 -> fp
hb LSHIFT 1 -> hv
lf RSHIFT 2 -> lg
gj RSHIFT 3 -> gl
ki OR kj -> kk
NOT ak -> al
ld OR le -> lf
ci RSHIFT 3 -> ck
1 AND cc -> cd
NOT kx -> ky
fp OR fv -> fw
ev AND ew -> ey
dt LSHIFT 15 -> dx
NOT ax -> ay
bp AND bq -> bs
NOT ii -> ij
ci AND ct -> cv
iq OR ip -> ir
x RSHIFT 2 -> y
fq OR fr -> fs
bn RSHIFT 5 -> bq
0 -> c
14146 -> b
d OR j -> k
z OR aa -> ab
gf OR ge -> gg
df OR dg -> dh
NOT hj -> hk
NOT di -> dj
fj LSHIFT 15 -> fn
lf RSHIFT 1 -> ly
b AND n -> p
jq OR jw -> jx
gn AND gp -> gq
x RSHIFT 1 -> aq
ex AND ez -> fa
NOT fc -> fd
bj OR bi -> bk
as RSHIFT 5 -> av
hu LSHIFT 15 -> hy
NOT gs -> gt
fs AND fu -> fv
dh AND dj -> dk
bz AND cb -> cc
dy RSHIFT 1 -> er
hc OR hd -> he
fo OR fz -> ga
t OR s -> u
b RSHIFT 2 -> d
NOT jy -> jz
hz RSHIFT 2 -> ia
kk AND kv -> kx
ga AND gc -> gd
fl LSHIFT 1 -> gf
bn AND by -> ca
NOT hr -> hs
NOT bs -> bt
lf RSHIFT 3 -> lh
au AND av -> ax
1 AND gd -> ge
jr OR js -> jt
fw AND fy -> fz
NOT iz -> ja
c LSHIFT 1 -> t
dy RSHIFT 5 -> eb
bp OR bq -> br
NOT h -> i
1 AND ds -> dt
ab AND ad -> ae
ap LSHIFT 1 -> bj
br AND bt -> bu
NOT ca -> cb
NOT el -> em
s LSHIFT 15 -> w
gk OR gq -> gr
ff AND fh -> fi
kf LSHIFT 15 -> kj
fp AND fv -> fx
lh OR li -> lj
bn RSHIFT 3 -> bp
jp OR ka -> kb
lw OR lv -> lx
iy AND ja -> jb
dy OR ej -> ek
1 AND bh -> bi
NOT kt -> ku
ao OR an -> ap
ia AND ig -> ii
NOT ey -> ez
bn RSHIFT 1 -> cg
fk OR fj -> fl
ce OR cd -> cf
eu AND fa -> fc
kg OR kf -> kh
jr AND js -> ju
iu RSHIFT 3 -> iw
df AND dg -> di
dl AND dn -> do
la LSHIFT 15 -> le
fo RSHIFT 1 -> gh
NOT gw -> gx
NOT gb -> gc
ir LSHIFT 1 -> jl
x AND ai -> ak
he RSHIFT 5 -> hh
1 AND lu -> lv
NOT ft -> fu
gh OR gi -> gj
lf RSHIFT 5 -> li
x RSHIFT 3 -> z
b RSHIFT 3 -> e
he RSHIFT 2 -> hf
NOT fx -> fy
jt AND jv -> jw
hx OR hy -> hz
jp AND ka -> kc
fb AND fd -> fe
hz OR ik -> il
ci RSHIFT 1 -> db
fo AND fz -> gb
fq AND fr -> ft
gj RSHIFT 2 -> gk
cg OR ch -> ci
cd LSHIFT 15 -> ch
jm LSHIFT 1 -> kg
ih AND ij -> ik
fo RSHIFT 3 -> fq
fo RSHIFT 5 -> fr
1 AND fi -> fj
1 AND kz -> la
iu AND jf -> jh
cq AND cs -> ct
dv LSHIFT 1 -> ep
hf OR hl -> hm
km AND kn -> kp
de AND dk -> dm
dd RSHIFT 5 -> dg
NOT lo -> lp
NOT ju -> jv
NOT fg -> fh
cm AND co -> cp
ea AND eb -> ed
dd RSHIFT 3 -> df
gr AND gt -> gu
ep OR eo -> eq
cj AND cp -> cr
lf OR lq -> lr
gg LSHIFT 1 -> ha
et RSHIFT 2 -> eu
NOT jh -> ji
ek AND em -> en
jk LSHIFT 15 -> jo
ia OR ig -> ih
gv AND gx -> gy
et AND fe -> fg
lh AND li -> lk
1 AND io -> ip
kb AND kd -> ke
kk RSHIFT 5 -> kn
id AND if -> ig
NOT ls -> lt
dw OR dx -> dy
dd AND do -> dq
lf AND lq -> ls
NOT kc -> kd
dy AND ej -> el
1 AND ke -> kf
et OR fe -> ff
hz RSHIFT 5 -> ic
dd OR do -> dp
cj OR cp -> cq
NOT dq -> dr
kk RSHIFT 1 -> ld
jg AND ji -> jj
he OR hp -> hq
hi AND hk -> hl
dp AND dr -> ds
dz AND ef -> eh
hz RSHIFT 3 -> ib
db OR dc -> dd
hw LSHIFT 1 -> iq
he AND hp -> hr
NOT cr -> cs
lg AND lm -> lo
hv OR hu -> hw
il AND in -> io
NOT eh -> ei
gz LSHIFT 15 -> hd
gk AND gq -> gs
1 AND en -> eo
NOT kp -> kq
et RSHIFT 5 -> ew
lj AND ll -> lm
he RSHIFT 3 -> hg
et RSHIFT 3 -> ev
as AND bd -> bf
cu AND cw -> cx
jx AND jz -> ka
b OR n -> o
be AND bg -> bh
1 AND ht -> hu
1 AND gy -> gz
NOT hn -> ho
ck OR cl -> cm
ec AND ee -> ef
lv LSHIFT 15 -> lz
ks AND ku -> kv
NOT ie -> if
hf AND hl -> hn
1 AND r -> s
ib AND ic -> ie
hq AND hs -> ht
y AND ae -> ag
NOT ed -> ee
bi LSHIFT 15 -> bm
dy RSHIFT 2 -> dz
ci RSHIFT 2 -> cj
NOT bf -> bg
NOT im -> in
ev OR ew -> ex
ib OR ic -> id
bn RSHIFT 2 -> bo
dd RSHIFT 2 -> de
bl OR bm -> bn
as RSHIFT 1 -> bl
ea OR eb -> ec
ln AND lp -> lq
kk RSHIFT 3 -> km
is OR it -> iu
iu RSHIFT 2 -> iv
as OR bd -> be
ip LSHIFT 15 -> it
iw OR ix -> iy
kk RSHIFT 2 -> kl
NOT bb -> bc
ci RSHIFT 5 -> cl
ly OR lz -> ma
z AND aa -> ac
iu RSHIFT 1 -> jn
cy LSHIFT 15 -> dc
cf LSHIFT 1 -> cz
as RSHIFT 3 -> au
cz OR cy -> da
kw AND ky -> kz
lx -> a
iw AND ix -> iz
lr AND lt -> lu
jp RSHIFT 5 -> js
aw AND ay -> az
jc AND je -> jf
lb OR la -> lc
NOT cn -> co
kh LSHIFT 1 -> lb
1 AND jj -> jk
y OR ae -> af
ck AND cl -> cn
kk OR kv -> kw
NOT cv -> cw
kl AND kr -> kt
iu OR jf -> jg
at AND az -> bb
jp RSHIFT 2 -> jq
iv AND jb -> jd
jn OR jo -> jp
x OR ai -> aj
ba AND bc -> bd
jl OR jk -> jm
b RSHIFT 1 -> v
o AND q -> r
NOT p -> q
k AND m -> n
as RSHIFT 2 -> at
EOD
                , 'result' => 40149],
        ];
    }

    public function day8ExamplesPart1(): array
    {
        return [
            ['input' => '""', 'result' => 2],
            ['input' => '"abc"', 'result' => 2],
            ['input' => '"aaa\"aaa"', 'result' => 3],
            ['input' => '"\x27"', 'result' => 5],
            ['input' => <<<'EOD'
""
"abc"
"aaa\"aaa"
"\x27"
EOD
                , 'result' => 12],
        ];
    }

    public function day8ExamplesPart2(): array
    {
        return [
            ['input' => '""', 'result' => 4],
            ['input' => '"abc"', 'result' => 4],
            ['input' => '"aaa\"aaa"', 'result' => 6],
            ['input' => '"\x27"', 'result' => 5],
            ['input' => <<<'EOD'
""
"abc"
"aaa\"aaa"
"\x27"
EOD
                , 'result' => 19],
        ];
    }

    public function day9ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
London to Dublin = 464
London to Belfast = 518
Dublin to Belfast = 141
EOD
                , 'result' => 605],
        ];
    }

    public function day9ExamplesPart2(): array
    {
        return [
            ['input' => <<<'EOD'
London to Dublin = 464
London to Belfast = 518
Dublin to Belfast = 141
EOD
                , 'result' => 982],
        ];
    }

    public function day10ExamplesPart1(): array
    {
        return [
            ['input' => '1', 'result' => 82350],
            ['input' => '11', 'result' => 107312],
            ['input' => '21', 'result' => 139984],
            ['input' => '1211', 'result' => 182376],
            ['input' => '111221', 'result' => 237746],
        ];
    }

    public function day10ExamplesPart2(): array
    {
        return [
            ['input' => '1', 'result' => 1166642],
            ['input' => '11', 'result' => 1520986],
            ['input' => '21', 'result' => 1982710],
            ['input' => '1211', 'result' => 2584304],
            ['input' => '111221', 'result' => 3369156],
        ];
    }

    public function day11ExamplesPart1(): array
    {
        return [
            ['input' => 'abcdefgh', 'result' => 'abcdffaa'],
            ['input' => 'ghijklmn', 'result' => 'ghjaabcc'],
        ];
    }

    public function day11ExamplesPart2(): array
    {
        return [
            ['input' => 'abcdefgh', 'result' => 'abcdffbb'],
            ['input' => 'ghijklmn', 'result' => 'ghjbbcdd'],
        ];
    }

    public function day12ExamplesPart1(): array
    {
        return [
            ['input' => '[1,2,3]', 'result' => 6],
            ['input' => '{"a":2,"b":4}', 'result' => 6],
            ['input' => '[[[3]]]', 'result' => 3],
            ['input' => '{"a":{"b":4},"c":-1}', 'result' => 3],
            ['input' => '{"a":[-1,1]}', 'result' => 0],
            ['input' => '[-1,{"a":1}]', 'result' => 0],
            ['input' => '[]', 'result' => 0],
            ['input' => '{}', 'result' => 0],
        ];
    }

    public function day12ExamplesPart2(): array
    {
        return [
            ['input' => '[1,2,3]', 'result' => 6],
            ['input' => '1,{"c":"red","b":2},3]', 'result' => 4],
            ['input' => '{"d":"red","e":[1,2,3,4],"f":5}', 'result' => 0],
            ['input' => '[1,"red",5]', 'result' => 6],
        ];
    }

    public function day13ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
Alice would gain 54 happiness units by sitting next to Bob.
Alice would lose 79 happiness units by sitting next to Carol.
Alice would lose 2 happiness units by sitting next to David.
Bob would gain 83 happiness units by sitting next to Alice.
Bob would lose 7 happiness units by sitting next to Carol.
Bob would lose 63 happiness units by sitting next to David.
Carol would lose 62 happiness units by sitting next to Alice.
Carol would gain 60 happiness units by sitting next to Bob.
Carol would gain 55 happiness units by sitting next to David.
David would gain 46 happiness units by sitting next to Alice.
David would lose 7 happiness units by sitting next to Bob.
David would gain 41 happiness units by sitting next to Carol.
EOD
                , 'result' => 330],
        ];
    }

    public function day13ExamplesPart2(): array
    {
        return [
            ['input' => <<<'EOD'
Alice would gain 54 happiness units by sitting next to Bob.
Alice would lose 79 happiness units by sitting next to Carol.
Alice would lose 2 happiness units by sitting next to David.
Bob would gain 83 happiness units by sitting next to Alice.
Bob would lose 7 happiness units by sitting next to Carol.
Bob would lose 63 happiness units by sitting next to David.
Carol would lose 62 happiness units by sitting next to Alice.
Carol would gain 60 happiness units by sitting next to Bob.
Carol would gain 55 happiness units by sitting next to David.
David would gain 46 happiness units by sitting next to Alice.
David would lose 7 happiness units by sitting next to Bob.
David would gain 41 happiness units by sitting next to Carol.
EOD
                , 'result' => 286],
        ];
    }

    public function day14ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
Comet can fly 14 km/s for 10 seconds, but then must rest for 127 seconds.
Dancer can fly 16 km/s for 11 seconds, but then must rest for 162 seconds.
EOD
                , 'result' => 2660],
        ];
    }

    public function day14ExamplesPart2(): array
    {
        return [
            ['input' => <<<'EOD'
Comet can fly 14 km/s for 10 seconds, but then must rest for 127 seconds.
Dancer can fly 16 km/s for 11 seconds, but then must rest for 162 seconds.
EOD
                , 'result' => 1564],
        ];
    }

    public function day15ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
Butterscotch: capacity -1, durability -2, flavor 6, texture 3, calories 8
Cinnamon: capacity 2, durability 3, flavor -2, texture -1, calories 3
EOD
                , 'result' => 62842880],
        ];
    }

    public function day15ExamplesPart2(): array
    {
        return [
            ['input' => <<<'EOD'
Butterscotch: capacity -1, durability -2, flavor 6, texture 3, calories 8
Cinnamon: capacity 2, durability 3, flavor -2, texture -1, calories 3
EOD
                , 'result' => 57600000],
        ];
    }

    public function day16ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
Sue 1: vizslas: 0, cars: 2, perfumes: 5
Sue 2: trees: 2, cars: 3, vizslas: 8
Sue 3: trees: 10, children: 9, cats: 1
Sue 4: pomeranians: 3, perfumes: 1, vizslas: 0
Sue 5: vizslas: 0, perfumes: 6, trees: 0
Sue 6: vizslas: 7, pomeranians: 1, akitas: 10
Sue 7: vizslas: 8, trees: 2, cars: 10
Sue 8: perfumes: 9, cats: 5, goldfish: 5
Sue 9: cats: 0, akitas: 10, perfumes: 9
Sue 10: cars: 4, akitas: 1, trees: 1
EOD
                , 'result' => '4'],
        ];
    }

    public function day16ExamplesPart2(): array
    {
        return [
            ['input' => <<<'EOD'
Sue 1: akitas: 0, goldfish: 9, cars: 6
Sue 2: perfumes: 7, cars: 4, samoyeds: 5
Sue 3: akitas: 9, trees: 10, cars: 4
Sue 4: samoyeds: 10, children: 6, akitas: 7
Sue 5: trees: 8, goldfish: 8, perfumes: 8
Sue 6: goldfish: 3, akitas: 2, perfumes: 6
Sue 7: cats: 7, trees: 0, vizslas: 1
Sue 8: perfumes: 7, cars: 7, akitas: 7
Sue 9: goldfish: 0, vizslas: 0, samoyeds: 2
Sue 10: vizslas: 2, children: 2, cats: 3
EOD
                , 'result' => '9'],
        ];
    }

    public function day17ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
20
15
10
5
5
EOD
                , 'result' => 4],
        ];
    }

    public function day17ExamplesPart2(): array
    {
        return [];
    }

    public function day18ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
.#.#.#
...##.
#....#
..#...
#.#..#
####..
EOD
                , 'result' => 4],
        ];
    }

    public function day18ExamplesPart2(): array
    {
        return [];
    }

    public function day19ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
H => HO
H => OH
O => HH
EOD
                , 'result' => 4],
        ];
    }

    public function day19ExamplesPart2(): array
    {
        return [];
    }

    public function day20ExamplesPart1(): array
    {
        return [
            ['input' => <<<'EOD'
House 1 got 10 presents.
House 2 got 30 presents.
House 3 got 40 presents.
House 4 got 70 presents.
House 5 got 60 presents.
House 6 got 120 presents.
House 7 got 80 presents.
House 8 got 150 presents.
House 9 got 130 presents.
EOD
                , 'result' => 4],
        ];
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
        return [];
    }

    public function day24ExamplesPart2(): array
    {
        return [];
    }

    public function day25ExamplesPart1(): array
    {
        return [];
    }

    public function day25ExamplesPart2(): array
    {
        return [];
    }
}