<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D1')]
class D1Service implements DayServiceInterface
{
    private int $total = 0;
    private array $input = [];

    public function generatePart1(array $rows): string
    {
        $this->initInput($rows);
        $this->calculateFloor();
        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->initInput($rows);
        $this->findFirstBasementPosition();
        return $this->total;
    }

    private function initInput(array $rows): void
    {
        $this->input = str_split($rows[0]);
    }

    /**
     * Count all ( and ) values and subtract them from each-other.
     */
    private function calculateFloor(): void
    {
        $counts = array_count_values($this->input);
        $this->total = $counts['('] ?? 0 - $counts[')'] ?? 0;
    }

    /**
     * Walk over the array and fond the first time you reach the basement (level: -1)
     */
    private function findFirstBasementPosition(): void
    {
        $i = 1;
        $level = 0;
        foreach ($this->input as $direction) {
            if ($direction === '(') {
                $level++;
            } else if ($direction === ')') {
                $level--;
            }
            if ($level === -1) {
                $this->total = $i;
                return;
            }
            $i++;
        }
    }

    /**
     * $rows[0] can only contain ( or )
     *
     * @param array<string> $rows
     */
    public function isValidInput(array $rows): bool
    {
        preg_match('/^[()]+$/', $rows[0], $matches);
        if (empty($matches)) {
            return false;
        }
        return true;
    }
}