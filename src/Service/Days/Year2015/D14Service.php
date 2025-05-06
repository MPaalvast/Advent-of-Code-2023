<?php

namespace App\Service\Days\Year2015;

use App\Service\Days\DayServiceInterface;
use App\Service\Tools\Days\Year2015\Day14\ReindeerDto;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2015D14')]
class D14Service implements DayServiceInterface
{
    private int $total = 0;
    private int $time = 2503;
    private array $input = [];

    public function generatePart1(array $rows): string
    {
        $this->setInput($rows);
        $this->generateDistances();
        $this->getMaxDistance();

        return $this->total;
    }

    public function generatePart2(array $rows): string
    {
        $this->setInput($rows);
        $this->generatePoints();
        $this->getMaxPoints();

        return $this->total;
    }

    private function getMaxDistance(): void
    {
        /** @var ReindeerDto $reindeer */
        foreach ($this->input as $reindeer) {
            if ($reindeer->getDistanceTraveled() > $this->total) {
                $this->total = $reindeer->getDistanceTraveled();
            }
        }
    }

    private function getMaxPoints(): void
    {
        /** @var ReindeerDto $reindeer */
        foreach ($this->input as $reindeer) {
            if ($reindeer->getPoints() > $this->total) {
                $this->total = $reindeer->getPoints();
            }
        }
    }

    private function generateDistances(): void
    {
        /** @var ReindeerDto $reindeer */
        foreach ($this->input as $reindeer) {
            $maxDistanceTimes = floor($this->time / $reindeer->getMaxFlightTime());
            $secondsLeft = $this->time - ($maxDistanceTimes * $reindeer->getMaxFlightTime());
            if ($secondsLeft < $reindeer->getMaxFlyTime()) {
                $distance = (int)(($maxDistanceTimes * $reindeer->getMaxFlightDistance()) + ($secondsLeft * $reindeer->getDistancePerSecond()));
            } else {
                $distance = (int)(($maxDistanceTimes * $reindeer->getMaxFlightDistance()) + $reindeer->getMaxFlightDistance());
            }
            $reindeer->addDistanceTraveled($distance);
        }
    }

    private function setInput(array $rows): void
    {
        foreach ($rows as $line) {
            if (preg_match('/^(\w+) can fly (\d+) km\/s for (\d+) seconds, but then must rest for (\d+) seconds.$/', $line, $matches)) {
                [$full, $name, $distancePerSecond, $maxFlyTime, $restTime] = $matches;
                $this->input[] = new ReindeerDto($name, $distancePerSecond, $maxFlyTime, $restTime);
            }
        }
    }

    private function generatePoints(): void
    {
        $leadReindeer = null;
        for ($i=0; $i < $this->time; $i++) {
            /** @var ReindeerDto $reindeer */
            foreach ($this->input as $reindeer) {
                $maxDistanceTimes = floor($i / $reindeer->getMaxFlightTime());
                $secondsLeft = $i - ($maxDistanceTimes * $reindeer->getMaxFlightTime());
                if ($secondsLeft < $reindeer->getMaxFlyTime()) {
                    $reindeer->addDistanceTraveled($reindeer->getDistancePerSecond());
                }

                if (null === $leadReindeer || $leadReindeer->getDistanceTraveled() < $reindeer->getDistanceTraveled()) {
                    $leadReindeer = $reindeer;
                }
            }
            $leadReindeer->addPoint();
            foreach ($this->input as $reindeer) {
                if ($reindeer !== $leadReindeer && $reindeer->getDistanceTraveled() === $leadReindeer->getDistanceTraveled()) {
                    $reindeer->addPoint();
                }
            }
        }
    }

    public function isValidInput(array $rows): bool
    {
        foreach ($rows as $row) {
            preg_match('/^(\w+) can fly (\d+) km\/s for (\d+) seconds, but then must rest for (\d+) seconds.$/', $row, $matches);
            if (empty($matches)) {
                return false;
            }
        }
        return true;
    }
}