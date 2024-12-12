<?php

namespace App\Service\Days\Year2019;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2019D2')]
class D2Service implements DayServiceInterface
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