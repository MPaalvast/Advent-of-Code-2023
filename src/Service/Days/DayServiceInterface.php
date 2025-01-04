<?php

namespace App\Service\Days;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface DayServiceInterface
{
    public function generatePart1(array $rows): string;

    public function generatePart2(array $rows): string;
}
