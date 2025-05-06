<?php

namespace App\Service\Tools\Days\Year2015\Day14;

class ReindeerDto
{
    private string $name;
    private int $distancePerSecond;
    private int $maxFlyTime;
    private int $restTime;
    private int $maxFlightDistance;
    private int $maxFlightTime;
    private int $points = 0;
    private int $distanceTraveled = 0;
    public function __construct(string $name, int $distancePerSecond, int $maxFlyTime, int $restTime)
    {
        $this->name = $name;
        $this->distancePerSecond = $distancePerSecond;
        $this->maxFlyTime = $maxFlyTime;
        $this->restTime = $restTime;
        $this->maxFlightDistance = $this->maxFlyTime * $this->distancePerSecond;
        $this->maxFlightTime = $this->maxFlyTime + $this->restTime;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDistancePerSecond(): int
    {
        return $this->distancePerSecond;
    }

    public function getMaxFlyTime(): int
    {
        return $this->maxFlyTime;
    }

    public function getRestTime(): int
    {
        return $this->restTime;
    }

    public function getMaxFlightDistance(): int
    {
        return $this->maxFlightDistance;
    }

    public function getMaxFlightTime(): int
    {
        return $this->maxFlightTime;
    }
    public function getPoints(): int
    {
        return $this->points;
    }

    public function addPoint(): void
    {
        $this->points += 1;
    }

    public function getDistanceTraveled(): int
    {
        return $this->distanceTraveled;
    }

    public function addDistanceTraveled(int $distance): void
    {
        $this->distanceTraveled += $distance;
    }
}