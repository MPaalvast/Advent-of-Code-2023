<?php

namespace App\Controller;

use App\Service\Days\Year2023\Y2023D10Service;
use App\Service\Days\Year2023\Y2023D11Service;
use App\Service\Days\Year2023\Y2023D12Service;
use App\Service\Days\Year2023\Y2023D13Service;
use App\Service\Days\Year2023\Y2023D14Service;
use App\Service\Days\Year2023\Y2023D15Service;
use App\Service\Days\Year2023\Y2023D16Service;
use App\Service\Days\Year2023\Y2023D17Service;
use App\Service\Days\Year2023\Y2023D18Service;
use App\Service\Days\Year2023\Y2023D19Service;
use App\Service\Days\Year2023\Y2023D1Service;
use App\Service\Days\Year2023\Y2023D20Service;
use App\Service\Days\Year2023\Y2023D21Service;
use App\Service\Days\Year2023\Y2023D22Service;
use App\Service\Days\Year2023\Y2023D23Service;
use App\Service\Days\Year2023\Y2023D24Service;
use App\Service\Days\Year2023\Y2023D25Service;
use App\Service\Days\Year2023\Y2023D2Service;
use App\Service\Days\Year2023\Y2023D3Service;
use App\Service\Days\Year2023\Y2023D4Service;
use App\Service\Days\Year2023\Y2023D5Service;
use App\Service\Days\Year2023\Y2023D6Service;
use App\Service\Days\Year2023\Y2023D7Service;
use App\Service\Days\Year2023\Y2023D8Service;
use App\Service\Days\Year2023\Y2023D9Service;
use App\Service\Days\Year2024\Y2024D10Service;
use App\Service\Days\Year2024\Y2024D11Service;
use App\Service\Days\Year2024\Y2024D12Service;
use App\Service\Days\Year2024\Y2024D13Service;
use App\Service\Days\Year2024\Y2024D14Service;
use App\Service\Days\Year2024\Y2024D15Service;
use App\Service\Days\Year2024\Y2024D16Service;
use App\Service\Days\Year2024\Y2024D17Service;
use App\Service\Days\Year2024\Y2024D18Service;
use App\Service\Days\Year2024\Y2024D19Service;
use App\Service\Days\Year2024\Y2024D1Service;
use App\Service\Days\Year2024\Y2024D20Service;
use App\Service\Days\Year2024\Y2024D21Service;
use App\Service\Days\Year2024\Y2024D22Service;
use App\Service\Days\Year2024\Y2024D23Service;
use App\Service\Days\Year2024\Y2024D24Service;
use App\Service\Days\Year2024\Y2024D25Service;
use App\Service\Days\Year2024\Y2024D2Service;
use App\Service\Days\Year2024\Y2024D3Service;
use App\Service\Days\Year2024\Y2024D4Service;
use App\Service\Days\Year2024\Y2024D5Service;
use App\Service\Days\Year2024\Y2024D6Service;
use App\Service\Days\Year2024\Y2024D7Service;
use App\Service\Days\Year2024\Y2024D8Service;
use App\Service\Days\Year2024\Y2024D9Service;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;

class DaySelector
{
    public function __construct(
        #[AutowireLocator([
            'Y2023D1' => Y2023D1Service::class,
            'Y2023D2' => Y2023D2Service::class,
            'Y2023D3' => Y2023D3Service::class,
            'Y2023D4' => Y2023D4Service::class,
            'Y2023D5' => Y2023D5Service::class,
            'Y2023D6' => Y2023D6Service::class,
            'Y2023D7' => Y2023D7Service::class,
            'Y2023D8' => Y2023D8Service::class,
            'Y2023D9' => Y2023D9Service::class,
            'Y2023D10' => Y2023D10Service::class,
            'Y2023D11' => Y2023D11Service::class,
            'Y2023D12' => Y2023D12Service::class,
            'Y2023D13' => Y2023D13Service::class,
            'Y2023D14' => Y2023D14Service::class,
            'Y2023D15' => Y2023D15Service::class,
            'Y2023D16' => Y2023D16Service::class,
            'Y2023D17' => Y2023D17Service::class,
            'Y2023D18' => Y2023D18Service::class,
            'Y2023D19' => Y2023D19Service::class,
            'Y2023D20' => Y2023D20Service::class,
            'Y2023D21' => Y2023D21Service::class,
            'Y2023D22' => Y2023D22Service::class,
            'Y2023D23' => Y2023D23Service::class,
            'Y2023D24' => Y2023D24Service::class,
            'Y2023D25' => Y2023D25Service::class,
            'Y2024D1' => Y2024D1Service::class,
            'Y2024D2' => Y2024D2Service::class,
            'Y2024D3' => Y2024D3Service::class,
            'Y2024D4' => Y2024D4Service::class,
            'Y2024D5' => Y2024D5Service::class,
            'Y2024D6' => Y2024D6Service::class,
            'Y2024D7' => Y2024D7Service::class,
            'Y2024D8' => Y2024D8Service::class,
            'Y2024D9' => Y2024D9Service::class,
            'Y2024D10' => Y2024D10Service::class,
            'Y2024D11' => Y2024D11Service::class,
            'Y2024D12' => Y2024D12Service::class,
            'Y2024D13' => Y2024D13Service::class,
            'Y2024D14' => Y2024D14Service::class,
            'Y2024D15' => Y2024D15Service::class,
            'Y2024D16' => Y2024D16Service::class,
            'Y2024D17' => Y2024D17Service::class,
            'Y2024D18' => Y2024D18Service::class,
            'Y2024D19' => Y2024D19Service::class,
            'Y2024D20' => Y2024D20Service::class,
            'Y2024D21' => Y2024D21Service::class,
            'Y2024D22' => Y2024D22Service::class,
            'Y2024D23' => Y2024D23Service::class,
            'Y2024D24' => Y2024D24Service::class,
            'Y2024D25' => Y2024D25Service::class,
        ])]
        protected ContainerInterface $container,
    ){}

    public function getTitle(string $index): string
    {
        return $this->container->get($index)->getTitle();
    }

    public function generatePart1(string $index, array|\Generator $rows): string
    {
        return $this->container->get($index)->generatePart1($rows);
    }

    public function generatePart2(string $index, array|\Generator $rows): string
    {
        return $this->container->get($index)->generatePart1($rows);
    }
}