<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D25')]
class D25Service implements DayServiceInterface
{
    public function generatePart1(array $rows): string
    {
        return '0';
    }

    public function generatePart2(array $rows): string
    {
        return '0';
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}
