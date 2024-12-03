<?php

declare(strict_types=1);

namespace App\Service\Days\Year2023;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\GridDumper;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2023D16')]
class Y2023D16Service implements DayServiceInterface
{
    private string $title = "The Floor Will Be Lava";

    public function getTitle(): string
    {
        return $this->title;
    }

    public function __construct(public array $grid = [], public array $energized = [], public int $maxHeight = 0, public int $maxWidth = 0, private array $maxResults = [])
    {
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->getGrid($rows);
        $direction = 'R';
        if ($this->grid[0][0] === '\\') {
            $direction = 'D';
        }

        $this->findAllEnergized('0-0', $direction);
        $this->calculateEnergigezedResult();

        return (string)$this->calculateEnergigezedResult();
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $this->maxResults = [
            'id' => '',
            'value' => 0
        ];

        $this->getGrid($rows);
        $this->generateBestEdgePosition();

        return (string)$this->maxResults['value'];
    }

    private function generateBestEdgePosition(): void
    {
        for ($y=0;$y<$this->maxWidth;$y++) {
            // top row
            $direction = 'D';
            if ($this->grid[0][$y] === '\\') {
                $direction = 'R';
            } elseif ($this->grid[0][$y] === '/') {
                $direction = 'L';
            }
            $this->findAllEnergized('0-' . $y, $direction);
            $result = $this->calculateEnergigezedResult();
            if ($result > $this->maxResults['value']) {
                $this->maxResults['value'] = $result;
                $this->maxResults['id'] = '0-' . $y;
            }

            // bottom row
            $direction = 'U';
            if ($this->grid[$this->maxWidth-1][$y] === '\\') {
                $direction = 'L';
            } elseif ($this->grid[$this->maxWidth-1][$y] === '/') {
                $direction = 'R';
            }
            $this->findAllEnergized($this->maxWidth-1 . '-' . $y, $direction);
            $result = $this->calculateEnergigezedResult();
            if ($result > $this->maxResults['value']) {
                $this->maxResults['value'] = $result;
                $this->maxResults['id'] = '0-' . $y;
            }
        }

        for ($x=0;$x<$this->maxHeight;$x++) {
            // left row
            $direction = 'R';
            if ($this->grid[$x][0] === '\\') {
                $direction = 'D';
            } elseif ($this->grid[$x][0] === '/') {
                $direction = 'U';
            }
            $this->findAllEnergized($x . '-0', $direction);
            $result = $this->calculateEnergigezedResult();
            if ($result > $this->maxResults['value']) {
                $this->maxResults['value'] = $result;
                $this->maxResults['id'] = $x . '-0';
            }

            // bottom row
            $direction = 'L';
            if ($this->grid[$x][$this->maxHeight-1] === '\\') {
                $direction = 'U';
            } elseif ($this->grid[$x][$this->maxHeight-1] === '/') {
                $direction = 'D';
            }
            $this->findAllEnergized($x . '-' . $this->maxHeight-1, $direction);
            $result = $this->calculateEnergigezedResult();
            if ($result > $this->maxResults['value']) {
                $this->maxResults['value'] = $result;
                $this->maxResults['id'] = '0-' . $y;
            }
        }
    }

    private function calculateEnergigezedResult(): int
    {
        return count(array_unique(array_merge(array_keys($this->energized['horizontal']), array_keys($this->energized['vertical']))));
    }

    private function findAllEnergized(string $startPosition, string $direction): void
    {
        $this->energized = ['horizontal' => [$startPosition => 1], 'vertical' => []];
        $loopData[] = [$startPosition => $direction];
        while (!empty($loopData)) {
            $currentField = array_shift($loopData);
            [$x, $y] = explode('-', key($currentField));
            $nextDirection = $currentField[$x . '-' . $y];
            switch($nextDirection) {
                case 'U':
                    $x--;
                    if ($x < 0) {
                        continue 2;
                    }
                    $exists = isset($this->energized['vertical'][$x . '-' . $y]) && $this->energized['vertical'][$x . '-' . $y] === $nextDirection;
                    if (!$exists) {
                        $this->energized['vertical'][$x . '-' . $y] = $nextDirection;
                    }

                    if ($this->grid[$x][$y] === '-') {
                        if ($exists) {
                            continue 2;
                        }
                        $loopData[] = [$x . '-' . $y => 'R'];
                        $loopData[] = [$x . '-' . $y => 'L'];
                        continue 2;
                    }
                    if ($this->grid[$x][$y] === '/') {
                        $loopData[] = [$x . '-' . $y => 'R'];
                        continue 2;
                    }
                    if ($this->grid[$x][$y] === '\\') {
                        $loopData[] = [$x . '-' . $y => 'L'];
                        continue 2;
                    }
                    if (in_array($this->grid[$x][$y], ['.', '|']) && !$exists) {
                        $loopData[] = [$x . '-' . $y => $nextDirection];
                    }
                    break;
                case 'R':
                    $y++;
                    if ($y >= $this->maxWidth) {
                        continue 2;
                    }
                    $exists = isset($this->energized['horizontal'][$x . '-' . $y]) && $this->energized['horizontal'][$x . '-' . $y] === $nextDirection;
                    if (!$exists) {
                        $this->energized['horizontal'][$x . '-' . $y] = $nextDirection;
                    }

                    if ($this->grid[$x][$y] === '|') {
                        if ($exists) {
                            continue 2;
                        }
                        $loopData[] = [$x . '-' . $y => 'U'];
                        $loopData[] = [$x . '-' . $y => 'D'];
                        continue 2;
                    }
                    if ($this->grid[$x][$y] === '/') {
                        $loopData[] = [$x . '-' . $y => 'U'];
                        continue 2;
                    }
                    if ($this->grid[$x][$y] === '\\') {
                        $loopData[] = [$x . '-' . $y => 'D'];
                        continue 2;
                    }
                    if (in_array($this->grid[$x][$y], ['.', '-']) && !$exists) {
                        $loopData[] = [$x . '-' . $y => $nextDirection];
                    }
                    break;
                case 'D':
                    $x++;
                    if ($x >= $this->maxHeight) {
                        continue 2;
                    }
                    $exists = isset($this->energized['vertical'][$x . '-' . $y]) && $this->energized['vertical'][$x . '-' . $y] === $nextDirection;
                    if (!$exists) {
                        $this->energized['vertical'][$x . '-' . $y] = $nextDirection;
                    }

                    if ($this->grid[$x][$y] === '-') {
                        if ($exists) {
                            continue 2;
                        }
                        $loopData[] = [$x . '-' . $y => 'R'];
                        $loopData[] = [$x . '-' . $y => 'L'];
                        continue 2;
                    }
                    if ($this->grid[$x][$y] === '/') {
                        $loopData[] = [$x . '-' . $y => 'L'];
                        continue 2;
                    }
                    if ($this->grid[$x][$y] === '\\') {
                        $loopData[] = [$x . '-' . $y => 'R'];
                        continue 2;
                    }
                    if (in_array($this->grid[$x][$y], ['.', '|']) && !$exists) {
                        $loopData[] = [$x . '-' . $y => $nextDirection];
                    }
                    break;
                case 'L':
                    $y--;
                    if ($y < 0) {
                        continue 2;
                    }
                    $exists = isset($this->energized['horizontal'][$x . '-' . $y]) && $this->energized['horizontal'][$x . '-' . $y] === $nextDirection;
                    if (!$exists) {
                        $this->energized['horizontal'][$x . '-' . $y] = $nextDirection;
                    }

                    if ($this->grid[$x][$y] === '|') {
                        if ($exists) {
                            continue 2;
                        }
                        $loopData[] = [$x . '-' . $y => 'U'];
                        $loopData[] = [$x . '-' . $y => 'D'];
                        continue 2;
                    }
                    if ($this->grid[$x][$y] === '/') {
                        $nextDirection = 'D';
                        $loopData[] = [$x . '-' . $y => 'D'];
                        continue 2;
                    }
                    if ($this->grid[$x][$y] === '\\') {
                        $loopData[] = [$x . '-' . $y => 'U'];
                        continue 2;
                    }
                    if (in_array($this->grid[$x][$y], ['.', '-']) && !$exists) {
                        $loopData[] = [$x . '-' . $y => $nextDirection];
                    }
                    break;
            }

        }
    }

    private function getGrid($rows): void
    {
        $this->grid = [];
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                break;
            }

            $this->grid[] = str_split($row);
        }
        $this->maxHeight = count($this->grid);
        $this->maxWidth = count($this->grid[0]);
    }

    private function changeDirection(string $direction, string $fieldValue): string
    {
        switch ($direction){
            case 'U':
                $newDirection = $fieldValue === "/" ? 'R' : 'L';
                break;
            case 'R':
                $newDirection = $fieldValue === "/" ? 'U' : 'D';
                break;
            case 'D':
                $newDirection = $fieldValue === "/" ? 'L' : 'R';
                break;
            case 'L':
                $newDirection = $fieldValue === "/" ? 'D' : 'U';
                break;
        }

        return $newDirection;
    }
}
