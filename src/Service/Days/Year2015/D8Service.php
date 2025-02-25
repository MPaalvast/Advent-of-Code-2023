<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D8')]
class D8Service implements DayServiceInterface
{
    private int $total = 0;
    private int $literalChars = 0;
    private int $actualChars = 0;
    private int $escapedChars = 0;

    public function generatePart1(array $rows): string
    {
        $this->calculateTotals($rows);
        $this->setTotalPart1();
        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->calculateTotals($rows);
        $this->setTotalPart2();
        return $this->total;
    }

    private function setTotalPart1(): void
    {
        $this->total = $this->literalChars - $this->actualChars;
    }

    private function setTotalPart2(): void
    {
        $this->total = $this->escapedChars - $this->literalChars;
    }

    private function calculateTotals(array $rows): void
    {
        foreach ($rows as $row) {
            $this->getLiteralChars($row);
            $this->getActualChars($row);
            $this->getEscapedChars($row);
        }
    }

    private function getLiteralChars(string $row): void
    {
        $this->literalChars += strlen($row);
    }

    private function getActualChars(string $row): void
    {
        $string = substr($row, 1, -1);
        $string = $this->replaceHexChars($string);
        $string = $this->replaceStrings($string);

        $this->actualChars += strlen($string);
    }

    private function getEscapedChars(string $row): void
    {
        $string = sprintf("\"%s\"", addslashes($row));
        $this->escapedChars += strlen($string);
    }

    private function replaceStrings(string $string): string
    {
        return preg_replace_callback('/\\\(\\\)|\\\(\")/', static function($matches) {
            return $matches[2] ?? $matches[1];
        }, $string);
    }

    private function replaceHexChars(string $string)
    {
        return preg_replace_callback('/\\\x([0-9A-Fa-f]{2})/', static function($matches) {
            return chr(hexdec($matches[1])); // Zet de hexadecimale waarde om naar een teken
        }, $string);
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^\"[\w\\\"]{0,}\"$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}