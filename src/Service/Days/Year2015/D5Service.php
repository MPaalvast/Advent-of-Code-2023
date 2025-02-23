<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D5')]
class D5Service implements DayServiceInterface
{
    private int $total = 0;

    public function generatePart1(array $rows): string
    {
        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        return $this->total;
    }
    // [aeiou] get vowels
    // ([a-z])(?=.*\1) get double letters
    // (ab)|(bc)|(cd)|(de)|(ef)|(fg)|(gh)|(hi)|(ij)|(jk)|(kl)|(lm)|(mn)|(no)|(op)|(pq)|(qr)|(rs)|(st)|(tu)|(uv)|(vw)|(wx)|(xy)|(yz) get 2 following letters

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}