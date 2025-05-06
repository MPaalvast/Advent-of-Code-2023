<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D12')]
class D12Service implements DayServiceInterface
{
    private int $total = 0;
    private string $input = '';
    private string $forbiddenString = '';

    public function generatePart1(array $rows): string
    {
        $this->getInput($rows);
        $this->setTotal();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->getInput($rows);
        $this->forbiddenString = ':"red"';

        $this->findAndRemoveForbiddenString();
        $this->setTotal();

        return $this->total;
    }

    private function setTotal(): void
    {
        preg_match_all('/-?\d+/', $this->input, $matches);

        $this->total = array_sum(array_values($matches[0]));
    }

    private function getInput(array $rows): void
    {
        $this->input = $rows[0];
    }

    private function findAndRemoveForbiddenString(): void
    {
        while (true) {
            $pos = strpos($this->input, '}');

            if ($pos === false) {
                break;
            }

            $strPart = substr($this->input, 0, $pos+1);
            $strToCheck = strrchr($strPart, '{');

            if (str_contains($strToCheck, $this->forbiddenString)) {
                $this->input = str_replace($strToCheck, '[]', $this->input);
            } else {
                $this->input = str_replace($strToCheck, '[' . substr($strToCheck, 1, -1) . ']', $this->input);
            }
        }
    }

    public function isValidInput(array $rows): bool
    {
        return true;
    }
}