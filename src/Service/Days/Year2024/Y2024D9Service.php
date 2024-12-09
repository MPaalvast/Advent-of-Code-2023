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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->getBlockAndFileArray($rows);
        $this->moveFileBlocks();
        $this->calculateChecksum();

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return $this->total;
    }

    private function getBlockAndFileArray(array|\Generator $rows): void
    {
        foreach ($rows as $row) {
            $parts = str_split($row);
            $fileIndex = 0;
            $i = 0;
            foreach ($parts as $part) {
                if ($i % 2 === 0) {
                    // file
                    for ($y=0; $y<(int)$part; $y++) {
                        $this->blockAndFileArray[] = $fileIndex;
                    }
                    $fileIndex++;
                } else {
                    // space
                    for ($y=0; $y<(int)$part; $y++) {
                        $this->blockAndFileArray[] = '.';
                    }
                }

                $i++;
            }
        }
    }

    private function moveFileBlocks(): void
    {
        // while . is before last number
            // switch . and number

        // find all . in array and keep key
//        [$dotPos, $nrPos, $nr] = $this->getStrPosData();
//        while ($dotPos < $nrPos) {
//
//            $this->blockAndFileString = substr_replace($this->blockAndFileString, $nr, $dotPos, 1);
//            $this->blockAndFileString = substr_replace($this->blockAndFileString, '.', $nrPos, 1);
//
//            [$dotPos, $nrPos, $nr] = $this->getStrPosData();
//
//        }
//        dd($this->blockAndFileString);
    }

    private function getStrPosData(): array
    {
//        $dotPos = strpos($this->blockAndFileString, '.');
//        preg_match('/(\d)\D*$/', $this->blockAndFileString, $nr);
//        $nrPos = strrpos($this->blockAndFileString, $nr[1]);
//
//        return [$dotPos, $nrPos, $nr[1]];
    }

    private function calculateChecksum(): void
    {
        foreach ($this->blockAndFileArray as $index => $part) {
            if ($part === '.') {
                break;
            }
            $this->total += (int)$index * (int)$part;
        }
    }
}
