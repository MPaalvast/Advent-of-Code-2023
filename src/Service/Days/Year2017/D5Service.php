<?php

namespace App\Service\Days\Year2017;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2017D5')]
class D5Service implements DayServiceInterface
{
    private string $title = "???";
    private int $total = 0;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return $this->total;
    }
}