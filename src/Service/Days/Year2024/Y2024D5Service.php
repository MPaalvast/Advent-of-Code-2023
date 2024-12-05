<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D5')]
class Y2024D5Service implements DayServiceInterface
{
    private string $title = "Print Queue";
    private array $order = [];
    private array $update = [];
    private array $correctUpdate = [];
    private array $wrongUpdate = [];

    private int $total = 0;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function generatePart1(array|\Generator $rows): string
    {
        $this->makeInput($rows);
        $this->getUpdates();
        $this->calculateCorrectUpdates($this->correctUpdate);

        return $this->total;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        $this->makeInput($rows);
        $this->getUpdates();
        $this->orderWrongUpdates();
        $this->calculateCorrectUpdates($this->wrongUpdate);

        return $this->total;
    }

    //
    // helper functions below
    //

    private function makeInput(array|\Generator $rows): void
    {
        $i = 'orders';
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                if ($i === 'orders') {
                    $i = 'update';
                }
                continue;
            }

            if ($i === 'orders') {
                [$page,$updatePage] = explode('|',$row);
                $this->order[$page][] = $updatePage;
            } elseif ($i === 'update') {
                $this->update[] = $row;
            }
        }
    }

    private function getUpdates(): void
    {
        foreach ($this->update as $update) {
            $goodUpdate = true;
            $updateArray = explode(',', $update);
            while (!empty($updateArray)) {
                $key = array_shift($updateArray);
                if (!$this->rightOrder($key, $updateArray)) {
                    $goodUpdate = false;
                    break;
                }
            }
            if ($goodUpdate) {
                $this->correctUpdate[] = $update;
            } else {
                $this->wrongUpdate[] = $update;
            }
        }
    }

    private function rightOrder(?string $key, array $updateArray): bool
    {
        foreach ($updateArray as $update) {
            if (
                !isset($this->order[$key]) ||
                !in_array($update, $this->order[$key], true)
            ) {
                return false;
            }
        }

        return true;
    }

    private function calculateCorrectUpdates(array $inputUpdates): void
    {
        foreach ($inputUpdates as $update) {
            $totalArray = explode(',', $update);
            $id = floor(count($totalArray)/2);
            $this->total += (int)$totalArray[$id];
        }
    }

    private function orderWrongUpdates(): void
    {
        foreach ($this->wrongUpdate as $key => $update) {
            $correctOrder = [];
            $updateArray = explode(',', $update);
            while (true) {
                $originalArray = array_values($updateArray);
                $totalUpdatesLeft = count($updateArray);
                if ($totalUpdatesLeft === 1) {
                    $correctOrder[] = $updateArray[0];
                    break;
                }
                foreach ($updateArray as $pageKey => $page) {
                    $randomPageArray = $originalArray;
                    unset($randomPageArray[$pageKey]);
                    if ($this->rightOrder($page, $randomPageArray)) {

                        $correctOrder[] = $page;
                        unset($updateArray[$pageKey]);
                        $updateArray = array_values($updateArray);
                    }
                }
                if ($totalUpdatesLeft === count($updateArray)) {
                    dump('Something is not correct here!');
                    break;
                }
            }
            $this->wrongUpdate[$key] = implode(',', $correctOrder);
        }
    }
}