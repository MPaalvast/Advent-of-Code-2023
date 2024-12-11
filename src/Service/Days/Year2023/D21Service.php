<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\GridDumper;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D21')]
class D21Service implements DayServiceInterface
{
    private string $title = "???";

    public function getTitle(): string
    {
        return $this->title;
    }

    public function __construct(public array $grid = [], public string $start = '', public array $blockedFields = [], public array $steps = ['evenSteps' => [], 'oddSteps' => [], 'allSteps' => []])
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->handleInput($rows);
        $steps = 64;
        if (count($this->grid[0]) === 11) {
            $steps = 6;
        }
        for ($i=1;$i<=$steps;$i++) {
            $this->walkStep($i);
        }
        return (string)count($this->steps['evenSteps']);
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return '0';
    }

    private function walkStep(int $stepNr): void
    {
        if ($stepNr === 1) {
            $stepsToCheck = [$this->start];
        } else {
            $stepsToCheck = $this->steps['newSteps'];
        }

        if (($stepNr%2) === 0) {
            $stepType = 'evenSteps';
        } else {
            $stepType = 'oddSteps';
        }

        $nextFields = $this->getNextFields($stepsToCheck);
        $this->steps['newSteps'] = $nextFields;
        $this->steps[$stepType] = array_unique(array_merge($this->steps[$stepType], $nextFields));
        $this->steps['allSteps'] = array_unique(array_merge($this->steps['allSteps'], $nextFields));
    }

    private function getNextFields(array $newSteps): array
    {
        $nextFields = [];
        foreach ($newSteps as $step) {
            [$x,$y] = explode('-', $step);
            $idUp = ($x-1) . '-' . $y;
            $idDown = ($x+1) . '-' . $y;
            $idLeft = $x . '-' . ($y-1);
            $idRight = $x . '-' . ($y+1);
            if (!isset($this->steps['allSteps'][$idUp]) && !isset($this->blockedFields[$idUp])) {
                $nextFields[] = $idUp;
            }
            if (!isset($this->steps['allSteps'][$idDown]) && !isset($this->blockedFields[$idDown])) {
                $nextFields[] = $idDown;
            }
            if (!isset($this->steps['allSteps'][$idLeft]) && !isset($this->blockedFields[$idLeft])) {
                $nextFields[] = $idLeft;
            }
            if (!isset($this->steps['allSteps'][$idRight]) && !isset($this->blockedFields[$idRight])) {
                $nextFields[] = $idRight;
            }
        }
        return array_unique($nextFields);
    }

    private function handleInput(array|\Generator$input): void
    {
        $i = 0;
        foreach ($input as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            $this->grid[$i] = str_split($row);

            // get blocked fields
            $result = array_keys( $this->grid[$i], "#" );
            foreach ($result as $key) {
                $this->blockedFields[$i . '-' . $key] = $i . '-' . $key;
            }

            // get startingPoint
            $value = array_keys( $this->grid[$i], "S" );
            if (!empty($value)) {
                $this->start = $i.'-'.$value[0];
            }

            $i++;
        }
    }
}
