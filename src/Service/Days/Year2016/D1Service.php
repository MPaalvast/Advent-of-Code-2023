<?php

namespace App\Service\Days\Year2016;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2016D1')]
class D1Service implements DayServiceInterface
{
    private int $total = 0;

    public function generatePart1(array|\Generator $rows): string
    {
        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return $this->total;
    }
}