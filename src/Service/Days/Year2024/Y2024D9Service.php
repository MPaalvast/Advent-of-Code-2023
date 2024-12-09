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
        $this->calculateChecksum();

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $this->getBlockAndFileArrayTotal($rows);
        $this->moveTotalFileBlocks();

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
                    for ($y=0; $y<(int)$part; $y++) {
                        $this->blockAndFileArray[] = $fileIndex;
                    }
                    $fileIndex++;
                } else {
                    // space
                    if ((int)$part > 0) {
                        for ($y = 0; $y < (int)$part; $y++) {
                            $this->blockAndFileArray[] = '.';
                        }
                    }
                }

                $i++;
            }
        }
        dump($this->blockAndFileArray);
    }

    private function getBlockAndFileArrayTotal(array|\Generator $rows): void
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
        }
//        dump($this->fileArray);
//        dump($this->blockArray);
    }

    private function moveFileBlocks(): void
    {
        $frontArray = [];
        $backArray = [];
        $array = $this->blockAndFileArray;

        while (!empty($array)) {
            $frontChar = array_shift($array);
            if ($frontChar !== '.') {
                // voeg de waarde aan de start string toe
                $frontArray[] = $frontChar;
            } else {
                // haal het laatste getal op in de $array
                while (!empty($array)) {
                    $backChar = array_pop($array);
                    array_unshift($backArray, '.');
                    if ($backChar !== '.') {
                        $frontArray[] = $backChar;
                        break;
                    }
                }
            }
        }

        $this->blockAndFileSortedArray = array_merge($frontArray, $backArray);
    }

    private function moveTotalFileBlocks(): void
    {
//        $array = $this->blockAndFileArray;
//        foreach (array_reverse($array) as $part) {
//            array_search('');
//        }
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

//$input = 2333133121414131402;
//
//$fileIndex = 2313244342
//$space = 333111110
//
//$test = [
//0 => [
//0 => 2
//],
//1 => [
//1 => 3
//],
//2 => [
//2 => 1
//],
//3 => [
//3 => 3
//],
//4 => [
//4 => 2
//],
//5 => [
//5 => 4
//],
//6 => [
//6 => 4
//],
//7 => [
//7 => 3
//],
//8 => [
//8 => 4
//],
//9 => [
//9 => 2
//],
//]
//
//$test1 = [
//0 => 2
//1 => 3
//2 => 1
//3 => 3
//4 => 2
//5 => 4
//6 => 4
//7 => 3
//8 => 4
//9 => 2
//]
//
//calculate count(index) * value
//    // 123 => 4 = 3*4 = 12
//    // 9 => 2 = 1*2 = 2
//$calculatedValue = 2
//
//$index = array_find_key($testDot, function (int $value) use (int $calculatedValue) {
//    return $value >= $calculatedValue;
//});
//
//// $textDot[$index] -= $calculatedValue;
//// $textDot[9] += $calculatedValue;
//// $test[$index] = $test[$index] + [9 => 2] // <-- $test1
//// unset($test[9][9])
//
//$testDot = [
//    0 => 3,
//    1 => 3,
//    2 => 3,
//    3 => 1,
//    4 => 1,
//    5 => 1,
//    6 => 1,
//    7 => 1,
//    8 => 0,
//]
}
