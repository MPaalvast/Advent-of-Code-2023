<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D15')]
class D15Service implements DayServiceInterface
{
    private int $total = 0;
    private int $maxX = 0;
    private int $maxY = 0;
    private bool $wide = false;
    private array $warehouseData = [];
    private array $movementInstructions = [];

    public function generatePart1(array $rows): string
    {
        $this->init($rows);
        $this->walkInstructions();
        $this->calculateTotal();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->wide = true;
        $this->initWide($rows);
        $this->walkInstructions();
        $this->calculateTotalWide();

        return $this->total;
    }

    private function init(array $rows): void
    {
        $type = 'location';
        $movementInstructions = [];
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                $type = 'movement';
                continue;
            }
            $rowParts = str_split($row);

            if ($type === 'location') {
                foreach ($rowParts as $y => $value) {
                    if ($value === '.') {
                        continue;
                    }
                    if ($value === '@') {
                        $this->warehouseData[$value] = $x . '-' . $y;
                        continue;
                    }
                    $this->warehouseData[$value][$x . '-' . $y] = $x . '-' . $y;
                }
            } else {
                $movementInstructions[] = $rowParts;
            }
        }
        $this->movementInstructions = array_merge(...$movementInstructions);
    }

    private function initWide(array $rows): void
    {
        $type = 'location';
        $movementInstructions = [];
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                $type = 'movement';
                continue;
            }
            $rowParts = str_split($row);

            if ($type === 'location') {
                foreach ($rowParts as $y => $value) {
                    if ($value === '.') {
                        continue;
                    }
                    if ($value === '@') {
                        $this->warehouseData[$value] = $x . '-' . $y*2;
                        continue;
                    }
                    if ($value === '#') {
                        $this->warehouseData[$value][$x . '-' . $y*2] = $x . '-' . $y*2;
                        $this->warehouseData[$value][$x . '-' . ($y*2)+1] = $x . '-' . ($y*2)+1;
                        if (($y*2)+1 > $this->maxY) {
                            $this->maxY = ($y*2)+1;
                        }
                        continue;
                    }
                    $this->warehouseData[$value][$x . '-' . $y*2] = $x . '-' . $y*2;
                }
                $this->maxX = $x;
            } else {
                $movementInstructions[] = $rowParts;
            }
        }
        $this->maxX++;
        $this->maxY++;
        $this->movementInstructions = array_merge(...$movementInstructions);
    }

    private function walkInstructions(): void
    {
        $this->dumpGrid();
        while (count($this->movementInstructions) > 0) {
            $instruction = array_shift($this->movementInstructions);
            $this->move($instruction);
        }
    }

    private function move(string $instruction):void
    {
        if ($this->wide) {
            $this->moveWide($instruction);
        } else {
            $this->moveNormal($instruction);
        }
    }

    private function moveNormal(string $instruction): void
    {
        $x = 0;
        $y = 0;
        if ($instruction === '^') {
            $x = -1;
        } elseif ($instruction === 'v') {
            $x = 1;
        } elseif ($instruction === '<') {
            $y = -1;
        } elseif ($instruction === '>') {
            $y = 1;
        }

        [$robotX, $robotY] = explode('-', $this->warehouseData['@']);
        $nextRobotX = (int)$robotX + $x;
        $nextRobotY = (int)$robotY + $y;
        $nextIndex = $nextRobotX . '-' . $nextRobotY;
        $nextRobotIndex = $nextRobotX . '-' . $nextRobotY;

        if (in_array($nextIndex, $this->warehouseData['#'], true)) {
            return;
        }

        if (in_array($nextIndex, $this->warehouseData['O'], true)) {
            while (in_array($nextIndex, $this->warehouseData['O'], true)) {
                $nextRobotX = (int)$nextRobotX + $x;
                $nextRobotY = (int)$nextRobotY + $y;
                $nextIndex = $nextRobotX . '-' . $nextRobotY;
            }
            if  (in_array($nextIndex, $this->warehouseData['#'], true)) {
                return;
            }
            $this->moveRobot($nextRobotIndex, true, $nextIndex);
        } else {
            $this->moveRobot($nextIndex);
        }
    }

    private function moveWide(string $instruction):void
    {
        $x = 0;
        $y = 0;
        if ($instruction === '^') {
            $x = -1;
        } elseif ($instruction === 'v') {
            $x = 1;
        } elseif ($instruction === '<') {
            $y = -1;
        } elseif ($instruction === '>') {
            $y = 1;
        }

        [$robotX, $robotY] = explode('-', $this->warehouseData['@']);
        $nextRobotX = (int)$robotX + $x;
        $nextRobotY = (int)$robotY + $y;
        $nextIndex = $nextRobotX . '-' . $nextRobotY;
        $nextRobotIndex = $nextRobotX . '-' . $nextRobotY;

        if (in_array($nextIndex, $this->warehouseData['#'], true)) {
            return;
        }

        if (
            ($instruction === '^' || $instruction === 'v') &&
            (in_array($nextRobotIndex, $this->warehouseData['O'], true) || in_array($nextRobotX . '-' . $nextRobotY-1, $this->warehouseData['O'], true))
        ) {
            $affectingBoxFields = [];
            $loopFields = [];
            $affectingBoxFields[] = $this->warehouseData['O'][$nextRobotIndex] ?? $this->warehouseData['O'][$nextRobotX . '-' . $nextRobotY - 1];
            $loopFields[] = $this->warehouseData['O'][$nextRobotIndex] ?? $this->warehouseData['O'][$nextRobotX . '-' . $nextRobotY - 1];
            while (!empty($loopFields)) {
                $field = array_shift($loopFields);
                [$nextRobotX, $nextRobotY] = explode('-', $field);
                $nextRobotX = (int)$nextRobotX + $x;
                $nextRobotY = (int)$nextRobotY + $y;
                $nextIndex = $nextRobotX . '-' . $nextRobotY;
                if  (
                    in_array($nextIndex, $this->warehouseData['#'], true) ||
                    in_array($nextRobotX . '-' . $nextRobotY+1, $this->warehouseData['#'], true)
                ) {
                    return;
                }
                if (in_array($nextIndex, $this->warehouseData['O'], true)) {
                    $loopFields[] = $this->warehouseData['O'][$nextIndex];
                    $affectingBoxFields[] = $nextIndex;
                }
                if (in_array($nextRobotX . '-' . $nextRobotY-1, $this->warehouseData['O'], true)) {
                    $loopFields[] = $this->warehouseData['O'][$nextRobotX . '-' . $nextRobotY-1];
                    $affectingBoxFields[] = $nextRobotX . '-' . $nextRobotY-1;
                }
                if (in_array($nextRobotX . '-' . $nextRobotY+1, $this->warehouseData['O'], true)) {
                    $loopFields[] = $this->warehouseData['O'][$nextRobotX . '-' . $nextRobotY+1];
                    $affectingBoxFields[] = $nextRobotX . '-' . $nextRobotY+1;
                }
            }
            while (!empty($affectingBoxFields)) {
                $boxField = array_pop($affectingBoxFields);
                [$boxFieldX, $boxFieldY] = explode('-', $boxField);
                unset($this->warehouseData['O'][$boxField]);
                $this->warehouseData['O'][(int)$boxFieldX+$x . '-' . (int)$boxFieldY+$y] = (int)$boxFieldX+$x . '-' . (int)$boxFieldY+$y;
            }
            $this->moveRobot($nextRobotIndex);
        } elseif (
            ($instruction === '<' || $instruction === '>') &&
            (in_array($nextRobotIndex, $this->warehouseData['O'], true) || in_array($nextRobotX . '-' . $nextRobotY - 1, $this->warehouseData['O'], true))
        ) {
            $affectingBoxFields = [];
            $nextIndex = $this->warehouseData['O'][$nextRobotIndex] ?? $this->warehouseData['O'][$nextRobotX . '-' . $nextRobotY - 1];

            while (in_array($nextIndex, $this->warehouseData['O'], true)) {
                $affectingBoxFields[] = $this->warehouseData['O'][$nextIndex];
                [$fieldX, $fieldY] = explode('-', $nextIndex);
                if ($instruction === '>') {
                    $nextY = (int)$fieldY + $y+$y;
                } else {
                    $nextY = (int)$fieldY + $y;
                }
                $nextIndex = $fieldX . '-' . $nextY;
                if (in_array($nextIndex, $this->warehouseData['#'], true)) {
                    return;
                }
                if ($instruction === '<') {
                    $nextIndex = $fieldX . '-' . $nextY + $y;
                }
            }

            while (!empty($affectingBoxFields)) {
                $boxField = array_pop($affectingBoxFields);
                [$boxFieldX, $boxFieldY] = explode('-', $boxField);
                unset($this->warehouseData['O'][$boxField]);
                $this->warehouseData['O'][(int)$boxFieldX . '-' . (int)$boxFieldY+$y] = (int)$boxFieldX . '-' . (int)$boxFieldY+$y;
            }
            $this->moveRobot($nextRobotIndex);
        } else {
            $this->moveRobot($nextIndex);
        }
    }

    private function moveRobot(string $to, bool $movesBoxes = false, string $boxTo = ''): void
    {
        if ($movesBoxes) {
            $this->warehouseData['O'][$boxTo] = $boxTo;
            unset($this->warehouseData['O'][$to]);
        }
        $this->warehouseData['@'] = $to;
    }

    private function calculateTotal(): void
    {
        foreach ($this->warehouseData['O'] as $location) {
            [$locationX, $locationY] = explode('-', $location);
            $this->total += (100 * (int)$locationX) + (int)$locationY;
        }
    }

    private function calculateTotalWide()
    {
        foreach ($this->warehouseData['O'] as $location) {
            [$locationX, $locationY] = explode('-', $location);
            $locationX = (int)$locationX;
            $locationY = (int)$locationY;

            $this->total += (100 * $locationX) + $locationY;
        }
    }

    private function dumpGrid(): void
    {
        $dump = '';

        for ($x=0; $x < $this->maxX+1; $x++) {
            $row = [];
            for ($y=0; $y < $this->maxY; $y++) {
                if (in_array($x.'-'.$y, $this->warehouseData['O'])) {
                    $row[] = '[';
                    $row[] = ']';
                    $y++;
                } elseif (in_array($x.'-'.$y, $this->warehouseData['#'])) {
                    $row[] = '#';
                } elseif ($this->warehouseData['@'] === $x.'-'.$y) {
                    $row[] = '@';
                } else {
                    $row[] = '.';
                }
            }
            $dump .= implode('', $row) . "\n";
        }

        dump($dump);
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}