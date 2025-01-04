<?php

namespace App\Service\Days\Year2021;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2021D13')]
class D13Service implements DayServiceInterface
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