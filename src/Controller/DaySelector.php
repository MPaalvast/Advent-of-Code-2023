<?php

namespace App\Controller;

use App\Service\Days\DayServiceInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;

class DaySelector
{
    public function __construct(
        #[AutowireLocator(DayServiceInterface::class)]
        protected ContainerInterface $container,
    ){}

    public function generatePart1(string $index, array $rows): string
    {
        return $this->container->get($index)->generatePart1($rows);
    }

    public function generatePart2(string $index, array $rows): string
    {
        return $this->container->get($index)->generatePart2($rows);
    }
}