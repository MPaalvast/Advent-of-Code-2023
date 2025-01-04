<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D25')]
class D25Service implements DayServiceInterface
{
    private int $maxColumnValue = 6;
    private array $keys = [];
    private array $locks = [];
    private ?string $type = null;
    private int $total = 0;

    public function generatePart1(array $rows): string
    {
        $this->generateKeysAndLocks($rows);
        $this->checkLoseFitKeyAndLocks();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        return $this->total;
    }

    private function checkLoseFitKeyAndLocks(): void
    {
        foreach ($this->keys as $key) {
            foreach ($this->locks as $lock) {
                if ($this->canTurnLoseFitKey($key, $lock)) {
                    $this->total++;
                }
            }
        }
    }

    private function canTurnLoseFitKey(array $key, array $lock): bool
    {
        $fit = true;
        for ($i=0; isset($key[$i]); $i++) {
            if (!$this->doesKeyColumnFitLock($key[$i], $lock[$i])) {
                $fit = false;
                break;
            }
        }
        return $fit;
    }

    private function generateKeysAndLocks(array $rows): void
    {
        $keyLockData = [];
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                $this->setKeyLockData($keyLockData);
                $keyLockData = [];
                $this->type = null;
                continue;
            }
            if ($this->type === null) {
                $this->getType($row);
                continue;
            }

            $partData = str_split($row);

            foreach ($partData as $key => $value) {
                if (!isset($keyLockData[$key])) {
                    $keyLockData[$key] = 0;
                }
                if ($value === '#') {
                    $keyLockData[$key]++;
                }
            }
        }
        // set last key/lock
        $this->setKeyLockData($keyLockData);
    }

    private function setKeyLockData(array $keyLockData): void
    {
        if ($this->type === 'key') {
            $this->keys[] = $keyLockData;
        } else {
            $this->locks[] = $keyLockData;
        }
    }

    private function getType(string $row): void
    {
        if ($row === '#####') {
            $this->type = 'key';
        } else {
            $this->type = 'lock';
        }
    }

    private function doesKeyColumnFitLock(int $keyColumn, $lockColumn): bool
    {
        return ($keyColumn + $lockColumn) <= $this->maxColumnValue;
    }

    public function isValidInput(array $rows): bool
    {
        // TODO: Implement isValidInput() method.
        return true;
    }
}
