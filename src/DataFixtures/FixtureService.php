<?php

namespace App\DataFixtures;

use App\Entity\GameDay;
use App\Entity\Year;
use App\Repository\DayRepository;
use Doctrine\Persistence\ObjectManager;

class FixtureService
{
    public function __construct(
        private DayRepository $dayRepository,
    )
    {
    }

    public function makeGameDays(ObjectManager $manager, Year $year, \Iterator $gameDays): void
    {
        foreach ($gameDays as $gameDayData) {
            $day = $this->dayRepository->findBy(['title' => $gameDayData['day']]);
            $gameDay = new GameDay();
            $gameDay->setTitle($gameDayData['title']);
            $gameDay->setDay($day);
            $gameDay->setYear($year);
            $gameDay->setStatus($gameDayData['status']);
            $manager->persist($gameDay);
        }
    }
}