<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D11')]
class D11Service implements DayServiceInterface
{
    private int $total = 0;
    private string $nextPassword = '';
    private string $input = '';

    public function generatePart1(array $rows): string
    {
        $this->getInput($rows);

        $this->findNextPassword($this->input);

        return $this->nextPassword;
    }

    public function generatePart2(array $rows): string
    {
        $this->getInput($rows);

        $this->findNextPassword($this->input);
        $this->findNextPassword($this->nextPassword);

        return $this->nextPassword;
    }

    private function getInput(array $rows): void
    {
        $this->input = $rows[0];
    }

    private function findNextPassword(string $input): void
    {
        while (true) {
            $input = $this->incrementString($input);

            if ($this->hasSpecialChars($input)) {
                $input = $this->getNextValidString($input);
            }

            $overlappingPairs = $this->findNonOverlappingPairs($input);
            if (
                isset($overlappingPairs[1]) &&
                $this->hasConsecutiveLetters($input) &&
                !$this->hasSpecialChars($input)
            ) {
                $this->nextPassword = $input;
                break;
            }
        }
    }

    private function getNextValidString(string $input): string
    {
        $chars = str_split($input);
        $i = count($chars) - 1;

        while ($i >= 0) {
            if (!in_array($chars[$i], ["i", "o", "l"], true)) {
                $chars[$i] = 'a';
                $i--;
            } else {
                $chars[$i] = chr(ord($chars[$i]) + 1);
                return implode('', $chars); // klaar
            }
        }

        return implode('', $chars); // klaar
    }

    private function incrementString(string $input): string
    {
        $chars = str_split($input);
        $i = count($chars) - 1;

        while ($i >= 0) {
            if ($chars[$i] === 'z') {
                $chars[$i] = 'a';
                $i--; // carry
            } else {
                $chars[$i] = chr(ord($chars[$i]) + 1);
                return implode('', $chars); // klaar
            }
        }

        // Als we hier zijn: alles was 'z' → voeg een extra 'a' toe aan begin
        return 'a' . implode('', $chars);
    }

    private function findNonOverlappingPairs($string): array
    {
        preg_match_all('/([a-z])\1/', $string, $matches);
        return $matches[0];  // bevat alle niet-overlappende paren
    }

    private function hasConsecutiveLetters($string): bool
    {
        $pattern = '/abc|bcd|cde|def|efg|fgh|ghi|hij|ijk|jkl|klm|lmn|mno|nop|opq|pqr|qrs|rst|stu|tuv|uvw|vwx|wxy|xyz/i';
        return preg_match($pattern, $string) === 1;
    }

    private function hasSpecialChars($string): bool
    {
        $pattern = '/[iol]/';
        return preg_match($pattern, $string) === 1;
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^[a-z]+$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}