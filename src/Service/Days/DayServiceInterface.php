<?php

namespace App\Service\Days;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface DayServiceInterface
{
    public function getTitle(): string;

    public function generatePart1(array|\Generator $rows): string;

    public function generatePart2(array|\Generator $rows): string;
}
