<?php

namespace App\Service\Days\Year2025;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2025D2')]
class D2Service implements DayServiceInterface
{
    private array $data = [];
    private array $invalidIds = [];
    private string $type = '';
    public function generatePart1(array $rows): string
    {
        $this->type = 'double';
        $this->setData($rows[0]);
        $this->calculateInvalidIds();

        return array_sum($this->invalidIds);
    }

    public function generatePart2(array $rows): string
    {
        $this->type = 'multiple';
        $this->setData($rows[0]);
        $this->calculateInvalidIds();

        return array_sum($this->invalidIds);
    }

    private function calculateInvalidIds(): void
    {
        foreach ($this->data as $row) {
            if ($this->type === 'double') {
                $this->getInvalidIds($row);
            } else {
                $this->getInvalidMultipleIds($row);
            }
        }
    }

    private function getInvalidMultipleIds(array $row): void
    {
        $start = $row['start'];
        $end = $row['end'];

        if (strlen($start) === strlen($end)) {
            $this->loopPossibleInvalidIds($start, $end);
        } else {
            $this->loopPossibleInvalidIds($start, $end, true);
        }
    }

    private function loopPossibleInvalidIds(int $start, int $end, $biggerEnd = false): void
    {
        $this->collectInvalidIds($start, $start, $end, true);

        if ($biggerEnd) {
            $this->collectInvalidIds($end, $start, $end, false);
        }
    }

    private function collectInvalidIds(string $baseNumber, int $start, int $end, bool $incrementY): void {
        $length = strlen($baseNumber);
        $x = 1;

        while ($x <= ($length / 2)) {
            $y = (int) substr($baseNumber, 0, $x);
            if (($length % strlen((string)$y)) === 0) {
                while (strlen((string)$y) === $x && $y > 0) {
                    $newNumberToTest = (int) str_pad('', $length, (string)$y);
                    if ($incrementY) {
                        if ($newNumberToTest < $start) {
                            $y++;
                            continue;
                        }
                        if ($newNumberToTest > $end) {
                            break;
                        }
                        $y++;
                    } else {
                        if ($newNumberToTest > $end) {
                            $y--;
                            continue;
                        }
                        if ($newNumberToTest < $start) {
                            break;
                        }
                        $y--;
                    }

                    if (!isset($this->invalidIds[$newNumberToTest])) {
                        $this->invalidIds[$newNumberToTest] = $newNumberToTest;
                    }
                }
            }
            $x++;
        }
    }

    private function getInvalidIds(array $row): void
    {
        $start = $row['start'];
        $end = $row['end'];

        $firstNumberPart = $this->getFirstNumberPart($start);
        $this->findInvalidIds($firstNumberPart, $start, $end);
    }

    private function findInvalidIds(int $firstNumberPart, int $start, int $end): void
    {
        while (sprintf("%d%d", $firstNumberPart, $firstNumberPart) <= $end) {
            $numberToCheck = sprintf("%d%d", $firstNumberPart, $firstNumberPart);
            if ($numberToCheck >= $start) {
                $this->invalidIds[] = $numberToCheck;
            }
            $firstNumberPart++;
        }
    }

    private function getFirstNumberPart(int $number): int
    {
        $numberLength = strlen($number);
        if ($numberLength % 2 !== 0) {
            $halfLength = ceil($numberLength / 2);
            $firstNumberPart = (int)str_pad(1,$halfLength,'0');
        } else {
            $firstNumberPart = (int)substr($number,0,$numberLength/2);
        }

        return $firstNumberPart;
    }

    private function setData(string $data): void
    {
        $sets = explode(',', $data);
        foreach ($sets as $set) {
            [$startNumber, $endNumber] = array_map('intval', explode('-', $set));
            $this->data[] = [
                'start' => $startNumber,
                'end' => $endNumber,
            ];
        }
    }

    public function isValidInput(array $rows): bool
    {
        preg_match('/^\d+-\d+(,\d+-\d+)*$/', $rows[0], $matches);
        if (empty($matches)) {
            return false;
        }
        return true;
    }
}