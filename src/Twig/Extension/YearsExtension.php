<?php

namespace App\Twig\Extension;

use App\Repository\YearRepository;
use App\Twig\Runtime\YearsExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class YearsExtension extends AbstractExtension
{
    public function __construct(
        private readonly YearRepository $yearRepository,
    ) {
    }
//    public function getFilters(): array
//    {
//        return [
//            // If your filter generates SAFE HTML, you should add a third
//            // parameter: ['is_safe' => ['html']]
//            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
//            new TwigFilter('filter_name', [YearsExtensionRuntime::class, 'doSomething']),
//        ];
//    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('list_active_years', [$this, 'listActiveYears']),
        ];
    }

    public function listActiveYears(): array
    {
        return $this->yearRepository->findBy(['active' => true], ['title' => 'DESC']);
    }
}
