<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\Grid\Dto\DfsDto;
use App\Service\Tools\Grid\Type\DfsGridBuilder;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D10')]
class D10Service implements DayServiceInterface
{
    private DfsDto $dfsDto;

    public function __construct(
        private readonly DfsGridBuilder $dfsGridBuilder
    ) {
    }


    public function generatePart1(array $rows): string
    {
        $this->initDay($rows);

        return $this->dfsDto->findPaths($this->dfsDto->getStartPosition(0, true), $this->dfsDto->getEndPosition(9, true));
    }

    public function generatePart2(array $rows): string
    {
        $this->initDay($rows);
        return $this->dfsDto->findAllPaths($this->dfsDto->getStartPosition(0, true), $this->dfsDto->getEndPosition(9, true));
    }

    private function initDay(array $rows): void
    {
        $this->dfsGridBuilder->setRows($rows);
        $this->dfsDto = $this->dfsGridBuilder->create();
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            if (false === preg_match('/\d+$/', $row)) {
                return false;
            }

        }

        return true;
    }
}
