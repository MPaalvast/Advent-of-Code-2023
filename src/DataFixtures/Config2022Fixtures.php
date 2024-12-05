<?php

namespace App\DataFixtures;

use App\DataFixtures\DayExamples\DayExamples2022;
use App\Entity\Day;
use App\Entity\DayPart;
use App\Entity\Year;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Config2022Fixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly FixtureService $fixtureService,
        private readonly DayExamples2022 $examples,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $year = new Year();
        $year->setTitle('2022');
        $year->setActive(true);
        $manager->persist($year);

        $gameDays = $this->gameDayIterator();
        $dayParts = [
            1 => $this->getReference('dayPart_1', DayPart::class),
            2 => $this->getReference('dayPart_2', DayPart::class),
        ];
        $this->fixtureService->makeGameDays($manager, $year, $gameDays, $dayParts);

        $manager->flush();
    }

    private function gameDayIterator(): \Iterator
    {
        yield ['day' => $this->getReference('day_1', Day::class), 'title' => "Calorie Counting", 'active' => false, 'examples' => $this->examples->getDay1Examples(), 'results' => $this->gameDayPartResultIterator(1)];
        yield ['day' => $this->getReference('day_2', Day::class), 'title' => "Rock Paper Scissors", 'active' => false, 'examples' => $this->examples->getDay2Examples(), 'results' => $this->gameDayPartResultIterator(2)];
        yield ['day' => $this->getReference('day_3', Day::class), 'title' => "Rucksack Reorganization", 'active' => false, 'examples' => $this->examples->getDay3Examples(), 'results' => $this->gameDayPartResultIterator(3)];
        yield ['day' => $this->getReference('day_4', Day::class), 'title' => "Camp Cleanup", 'active' => false, 'examples' => $this->examples->getDay4Examples(), 'results' => $this->gameDayPartResultIterator(4)];
        yield ['day' => $this->getReference('day_5', Day::class), 'title' => "Supply Stacks", 'active' => false, 'examples' => $this->examples->getDay5Examples(), 'results' => $this->gameDayPartResultIterator(5)];
        yield ['day' => $this->getReference('day_6', Day::class), 'title' => "Tuning Trouble", 'active' => false, 'examples' => $this->examples->getDay6Examples(), 'results' => $this->gameDayPartResultIterator(6)];
        yield ['day' => $this->getReference('day_7', Day::class), 'title' => "No Space Left On Device", 'active' => false, 'examples' => $this->examples->getDay7Examples(), 'results' => $this->gameDayPartResultIterator(7)];
        yield ['day' => $this->getReference('day_8', Day::class), 'title' => "Treetop Tree House", 'active' => false, 'examples' => $this->examples->getDay8Examples(), 'results' => $this->gameDayPartResultIterator(8)];
        yield ['day' => $this->getReference('day_9', Day::class), 'title' => "Rope Bridge", 'active' => false, 'examples' => $this->examples->getDay9Examples(), 'results' => $this->gameDayPartResultIterator(9)];
        yield ['day' => $this->getReference('day_10', Day::class), 'title' => "Cathode-Ray Tube", 'active' => false, 'examples' => $this->examples->getDay10Examples(), 'results' => $this->gameDayPartResultIterator(10)];
        yield ['day' => $this->getReference('day_11', Day::class), 'title' => "Monkey in the Middle", 'active' => false, 'examples' => $this->examples->getDay11Examples(), 'results' => $this->gameDayPartResultIterator(11)];
        yield ['day' => $this->getReference('day_12', Day::class), 'title' => "Hill Climbing Algorithm", 'active' => false, 'examples' => $this->examples->getDay12Examples(), 'results' => $this->gameDayPartResultIterator(12)];
        yield ['day' => $this->getReference('day_13', Day::class), 'title' => "Distress Signal", 'active' => false, 'examples' => $this->examples->getDay13Examples(), 'results' => $this->gameDayPartResultIterator(13)];
        yield ['day' => $this->getReference('day_14', Day::class), 'title' => "Regolith Reservoir", 'active' => false, 'examples' => $this->examples->getDay14Examples(), 'results' => $this->gameDayPartResultIterator(14)];
        yield ['day' => $this->getReference('day_15', Day::class), 'title' => "Beacon Exclusion Zone", 'active' => false, 'examples' => $this->examples->getDay15Examples(), 'results' => $this->gameDayPartResultIterator(15)];
        yield ['day' => $this->getReference('day_16', Day::class), 'title' => "Proboscidea Volcanium", 'active' => false, 'examples' => $this->examples->getDay16Examples(), 'results' => $this->gameDayPartResultIterator(16)];
        yield ['day' => $this->getReference('day_17', Day::class), 'title' => "Pyroclastic Flow", 'active' => false, 'examples' => $this->examples->getDay17Examples(), 'results' => $this->gameDayPartResultIterator(17)];
        yield ['day' => $this->getReference('day_18', Day::class), 'title' => "Boiling Boulders", 'active' => false, 'examples' => $this->examples->getDay18Examples(), 'results' => $this->gameDayPartResultIterator(18)];
        yield ['day' => $this->getReference('day_19', Day::class), 'title' => "Not Enough Minerals", 'active' => false, 'examples' => $this->examples->getDay19Examples(), 'results' => $this->gameDayPartResultIterator(19)];
        yield ['day' => $this->getReference('day_20', Day::class), 'title' => "Grove Positioning System", 'active' => false, 'examples' => $this->examples->getDay20Examples(), 'results' => $this->gameDayPartResultIterator(20)];
        yield ['day' => $this->getReference('day_21', Day::class), 'title' => "Monkey Math", 'active' => false, 'examples' => $this->examples->getDay21Examples(), 'results' => $this->gameDayPartResultIterator(21)];
        yield ['day' => $this->getReference('day_22', Day::class), 'title' => "Monkey Map", 'active' => false, 'examples' => $this->examples->getDay22Examples(), 'results' => $this->gameDayPartResultIterator(22)];
        yield ['day' => $this->getReference('day_23', Day::class), 'title' => "Unstable Diffusion", 'active' => false, 'examples' => $this->examples->getDay23Examples(), 'results' => $this->gameDayPartResultIterator(23)];
        yield ['day' => $this->getReference('day_24', Day::class), 'title' => "Blizzard Basin", 'active' => false, 'examples' => $this->examples->getDay24Examples(), 'results' => $this->gameDayPartResultIterator(24)];
        yield ['day' => $this->getReference('day_25', Day::class), 'title' => "Full of Hot Air", 'active' => false, 'examples' => $this->examples->getDay25Examples(), 'results' => $this->gameDayPartResultIterator(25)];
    }

    private function gameDayPartResultIterator(int $day): \Iterator
    {
        switch ($day) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
            case 22:
            case 23:
            case 24:
            case 25:
                yield ['part' => $this->getReference('dayPart_1', DayPart::class), 'solved' => false];
                yield ['part' => $this->getReference('dayPart_2', DayPart::class), 'solved' => false];
                break;
        }
    }

    public function getDependencies(): array
    {
        return [
            DayFixtures::class
        ];
    }
}