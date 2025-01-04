<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D1')]
class D1Service implements DayServiceInterface
{
    private int $total = 0;
    private array $input = [];

    public function generatePart1(array|\Generator $rows): string
    {
        $this->initInput($rows);
        $this->calculateFloor();
        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $this->initInput($rows);
        $this->findFirstBasementPosition();
        return $this->total;
    }

    private function initInput(array|\Generator $rows): void
    {
        $this->input = str_split($rows[0]);
    }

    private function calculateFloor(): void
    {
        $counts = array_count_values($this->input);
        $this->total = $counts['('] - $counts[')'];
    }

    private function findFirstBasementPosition(): void
    {
        $i = 1;
        $level = 0;
        foreach ($this->input as $direction) {
            $level += ($direction === '(' ? 1 : -1);
            if ($level === -1) {
                $this->total = $i;
                return;
            }
            $i++;
        }
    }
}