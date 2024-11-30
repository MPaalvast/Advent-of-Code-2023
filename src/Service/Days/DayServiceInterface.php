<?php

namespace App\Service\Days;

interface DayServiceInterface
{
    public function getTitle(): string;

    public function generatePart1(array|\Generator $rows): string;

    public function generatePart2(array|\Generator $rows): string;
}
