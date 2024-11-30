<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;

class Y2024D11Service implements DayServiceInterface
{
    private string $title = "???";

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        return 0;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return 0;
    }
}