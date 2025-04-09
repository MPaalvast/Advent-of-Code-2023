<?php

namespace App\DataFixtures;

use App\Entity\GameDay;
use App\Entity\GameDayInput;
use App\Entity\GameDayResult;
use App\Entity\Year;
use Doctrine\Persistence\ObjectManager;

readonly class FixtureService
{
    public function makeGameDays(ObjectManager $manager, Year $year, \Iterator $gameDays, array $dayParts): void
    {
        foreach ($gameDays as $gameDayData) {
            $gameDay = new GameDay();
            $gameDay->setTitle($gameDayData['title']);
            $gameDay->setDay($gameDayData['day']);
            $gameDay->setYear($year);
            $gameDay->setActive($gameDayData['active']);
            $manager->persist($gameDay);

            $i = 1;
            foreach ($gameDayData['examples'] as $exampleData) {
//                dump($exampleData);
                if (!empty($exampleData)) {
                    foreach ($exampleData as $example) {
                        $gameDayInput = new GameDayInput();
                        $gameDayInput->setGameDay($gameDay);
                        $gameDayInput->setDayPart($dayParts[$i]);
                        $gameDayInput->setInput($example['input']);
                        $gameDayInput->setResult($example['result']);
                        $manager->persist($gameDayInput);
                    }
                }
                $i++;
            }
//            dd('test');

            foreach ($gameDayData['results'] as $resultData) {
                $gameDayResult = new GameDayResult();
                $gameDayResult->setGameDay($gameDay);
                $gameDayResult->setDayPart($resultData['part']);
                $gameDayResult->setSolved($resultData['solved']);
                $manager->persist($gameDayResult);
            }
        }
    }
}