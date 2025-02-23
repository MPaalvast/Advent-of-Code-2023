<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D5')]
class D5Service implements DayServiceInterface
{
    private int $total = 0;
    private array $input = [];

    public function generatePart1(array $rows): string
    {
        $this->setInput($rows);
        $this->findNiceStringsPart1();
        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->setInput($rows);
        $this->findNiceStringsPart2();
        return $this->total;
    }

    private function setInput(array $rows): void
    {
        $this->input = $rows;
    }

    private function findNiceStringsPart1(): void
    {
        foreach ($this->input as $row) {
            if (
                $this->findDoubleLetters($row) &&
                !$this->findLinkedLetters($row) &&
                $this->findVowels($row)
            ) {
                $this->total++;
            }
        }
    }

    private function findNiceStringsPart2(): void
    {
        foreach ($this->input as $row) {
            if (
                $this->findDoublePairs($row) &&
                $this->containsSplitRepeatedLetter($row)
            ) {
                $this->total++;
            }
        }
    }

    /**
     * Find double pairs in string with key xx like (jg in jgvebdjgben, hh in djfhhesbfhhjn)
     */
    private function findDoublePairs(string $row): bool
    {
        $rowParts = str_split($row);
        $part1 = array_shift($rowParts);
        $part2 = array_shift($rowParts);

        while (!empty($rowParts)) {
            if (str_contains(implode('', $rowParts), sprintf("%s%s", $part1, $part2))) {
                return true;
            }
            $part1 = $part2;
            $part2 = array_shift($rowParts);
        }
        return false;
    }

    /**
     * Find letters with 1 different letter in between like aga, efe, nan
     */
    private function containsSplitRepeatedLetter(string $row): bool
    {
        $rowParts = str_split($row);
        $max = count($rowParts) - 2;
        for ($i = 0; $i < $max; $i++) {
            if ($rowParts[$i] === $rowParts[$i + 2]) {
                return true;
            }
        }
        return false;
    }

    /**
     * The string has to have alt least 3 vowels in it.
     */
    private function findVowels(string $row): bool
    {
        $minOccurrences = 3;
        preg_match_all('/[aeiou]/', $row, $matches);
        if (count($matches[0]) >= $minOccurrences) {
            return true;
        }
        return false;
    }

    /**
     * The string has to have at least 1 double letter in it
     */
    private function findDoubleLetters(string $row): bool
    {
        preg_match('/(aa)|(bb)|(cc)|(dd)|(ee)|(ff)|(gg)|(hh)|(ii)|(jj)|(kk)|(ll)|(mm)|(nn)|(oo)|(pp)|(qq)|(rr)|(ss)|(tt)|(uu)|(vv)|(ww)|(xx)|(yy)|(zz)/', $row, $matches);
        if (empty($matches)) {
            return false;
        }
        return true;
    }

    /**
     * The string can not contain any of the pairs ab,cd,pq,xy
     */
    private function findLinkedLetters(string $row): bool
    {
        preg_match('/(ab)|(cd)|(pq)|(xy)/', $row, $matches);
        if (empty($matches)) {
            return false;
        }
        return true;
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^([a-z]+)$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}