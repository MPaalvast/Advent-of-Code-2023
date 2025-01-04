<?php

namespace App\Service\Days\Year2021;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2021D16')]
class D16Service implements DayServiceInterface
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