<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D3')]
class Y2024D3Service implements DayServiceInterface
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