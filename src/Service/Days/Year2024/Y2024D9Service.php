<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D9')]
class Y2024D9Service implements DayServiceInterface
{
    private string $title = "Disk Fragmenter";

    private int $total = 0;

    private array $blockAndFileArray = [];
    private array $fileArray = [];
    private array $blockArray = [];

    private array $blockAndFileSortedArray = [];

    private string $blockAndFileString = '';

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->getBlockAndFileArray($rows);
        $this->moveFileBlocks();
        $this->calculateTotalChecksum();

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $this->getBlockAndFileArray($rows);
        $this->moveTotalFileBlocks();
        $this->calculateTotalChecksum();

        return $this->total;
    }

    private function getBlockAndFileArray(array|\Generator $rows): void
    {
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }
            $parts = str_split($row);
            $fileIndex = 0;
            $i = 0;
            foreach ($parts as $part) {
                if ($i % 2 === 0) {
                    // file
                    $this->fileArray[] = [$fileIndex => $part];
                    $fileIndex++;
                } else {
                    // space
                    $this->blockArray[] = (int)$part;
                }

                $i++;
            }
            $this->blockArray[] = 0;
        }
    }

    private function moveFileBlocks(): void
    {
        $fileArrayReversed = array_reverse($this->fileArray);
        foreach ($fileArrayReversed as $part) {
            $fileId = key($part);
            for ($i = 0; $i < $part[$fileId]; $i++) {
                foreach ($this->blockArray as $key => $value) {
                    if ($key >= $fileId) {
                        break;
                    }
                    if ($value > 0) {
                        $this->blockArray[$key]--;
                        if (count($this->fileArray[$fileId]) > 1) {
                            $this->blockArray[$fileId-1]++;
                        } else {
                            $this->blockArray[$fileId]++;
                        }
                        if (!isset($this->fileArray[$key][$fileId])) {
                            $this->fileArray[$key] += [$fileId => 1];
                        } else {
                            $this->fileArray[$key][$fileId]++;
                        }

                        $this->fileArray[$fileId][$fileId]--;
                        if ($this->fileArray[$fileId][$fileId] === 0) {
                            unset($this->fileArray[$fileId][$fileId]);
                        }

                        break;
                    }
                }
            }
        }
    }

    private function moveTotalFileBlocks(): void
    {
        $fileArrayReversed = array_reverse($this->fileArray);

        foreach ($fileArrayReversed as $part) {
            $fileId = key($part);
//            $fileDiskSize = strlen($fileId) * $part[$fileId];
            $fileDiskSize = $part[$fileId];
//dump($part);
            foreach ($this->blockArray as $key => $value) {
                if ($key > $fileId) {
                    break;
                }
                if ($value >= $fileDiskSize) {
                    $this->blockArray[$key] -= $fileDiskSize;
                    if (count($this->fileArray[$fileId]) > 1) {
                        $this->blockArray[$fileId-1] += $fileDiskSize;
                    } else {
                        $this->blockArray[$fileId] += $fileDiskSize;
                    }
                    $this->fileArray[$key] += $part;
                    unset($this->fileArray[$fileId][$fileId]);

                    break;
                }
            }
        }
//        dump($this->fileArray);
    }

    private function calculateChecksum(): void
    {
        foreach ($this->blockAndFileSortedArray as $index => $part) {
            if ($part === '.') {
                break;
            }
            $this->total += (int)$index * (int)$part;
        }
    }

    private function calculateTotalChecksum(): void
    {
        $i = 0;
        $string = '';
        foreach ($this->fileArray as $index => $parts) {
//            dump($parts);
            if (!empty($parts)) {
                foreach ($parts as $fileId => $amount) {
                    for ($y = 0; $y < (int)$amount; $y++) {
                        $string .= $fileId;
                        $this->total += $i * (int)$fileId;
                        $i++;
                    }
                }
            }
            $string .= str_repeat('.', $this->blockArray[$index]);
            $i += $this->blockArray[$index];
        }
//        dump($string);
    }

// 14295934907371 => to high
// 8187318443496 => to high
// 7051071286497 => to high
// 6426104779092 => ???
}
