<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D10')]
class D10Service implements DayServiceInterface
{
    private int $total = 0;
    private string $input = '';
    private int $versionNrs = 0;

    public function generatePart1(array $rows): string
    {
        $this->versionNrs = 40;
        $this->input = $rows[0];
        $this->generateVersions();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->versionNrs = 50;
        $this->input = $rows[0];
        $this->generateVersions();

        return $this->total;
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^\d+$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }

    private function generateVersions(): void
    {
        $input = $this->input;
        for ($i=0; $i<$this->versionNrs; $i++) {
            preg_match_all('/(\d)\1*/', $input, $matches);
            $newInput = '';
            foreach ($matches[0] as $y => $group) {
                $digit = $matches[1][$y];
                $length = strlen($group);
//                echo "Groep: '$group' → Getal: $digit, Lengte: $length\n";

                $newInput .= $length . $digit;
            }
            $input = $newInput;
        }
        $this->setTotal($input);
    }

    private function setTotal(string $value)
    {
        $this->total = strlen($value);
    }
}

///  /(\d)\1*/