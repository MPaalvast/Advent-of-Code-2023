<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D4')]
class D4Service implements DayServiceInterface
{
    private int $total = 0;
    private string $preferredPrefix = '';
    private string $input = '';

    public function generatePart1(array $rows): string
    {
        $this->preferredPrefix = '00000';
        $this->initInput($rows);
        $this->findKey();
        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->preferredPrefix = '000000';
        $this->initInput($rows);
        $this->findKey();
        return $this->total;
    }

    private function initInput(array $rows): void
    {
        $this->input = $rows[0];
    }

    private function findKey(): void
    {
        $i = 1;
        while (true) {
            if (str_starts_with(md5($this->input . $i), $this->preferredPrefix)) {
                $this->total = $i;
                break;
            }
            $i++;
        }
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}