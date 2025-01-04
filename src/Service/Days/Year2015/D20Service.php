<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D20')]
class D20Service implements DayServiceInterface
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
}