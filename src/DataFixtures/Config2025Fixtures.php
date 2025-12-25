<?php

namespace App\DataFixtures;

use App\DataFixtures\DayExamples\DayExamples2025;
use App\Entity\Day;
use App\Entity\DayPart;
use App\Entity\Year;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Config2025Fixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly FixtureService $fixtureService,
        private readonly DayExamples2025 $examples,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $year = new Year();
        $year->setTitle('2025');
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
        yield ['day' => $this->getReference('day_1', Day::class), 'title' => "Secret Entrance", 'active' => true, 'examples' => $this->examples->getDay1Examples(), 'results' => $this->gameDayPartResultIterator(1)];
        yield ['day' => $this->getReference('day_2', Day::class), 'title' => "Gift Shop", 'active' => true, 'examples' => $this->examples->getDay2Examples(), 'results' => $this->gameDayPartResultIterator(2)];
        yield ['day' => $this->getReference('day_3', Day::class), 'title' => "Lobby", 'active' => true, 'examples' => $this->examples->getDay3Examples(), 'results' => $this->gameDayPartResultIterator(3)];
        yield ['day' => $this->getReference('day_4', Day::class), 'title' => "Printing Department", 'active' => false, 'examples' => $this->examples->getDay4Examples(), 'results' => $this->gameDayPartResultIterator(4)];
        yield ['day' => $this->getReference('day_5', Day::class), 'title' => "Cafeteria", 'active' => false, 'examples' => $this->examples->getDay5Examples(), 'results' => $this->gameDayPartResultIterator(5)];
        yield ['day' => $this->getReference('day_6', Day::class), 'title' => "Trash Compactor", 'active' => false, 'examples' => $this->examples->getDay6Examples(), 'results' => $this->gameDayPartResultIterator(6)];
        yield ['day' => $this->getReference('day_7', Day::class), 'title' => "Laboratories", 'active' => false, 'examples' => $this->examples->getDay7Examples(), 'results' => $this->gameDayPartResultIterator(7)];
        yield ['day' => $this->getReference('day_8', Day::class), 'title' => "Playground", 'active' => false, 'examples' => $this->examples->getDay8Examples(), 'results' => $this->gameDayPartResultIterator(8)];
        yield ['day' => $this->getReference('day_9', Day::class), 'title' => "Movie Theater", 'active' => false, 'examples' => $this->examples->getDay9Examples(), 'results' => $this->gameDayPartResultIterator(9)];
        yield ['day' => $this->getReference('day_10', Day::class), 'title' => "Factory", 'active' => false, 'examples' => $this->examples->getDay10Examples(), 'results' => $this->gameDayPartResultIterator(10)];
        yield ['day' => $this->getReference('day_11', Day::class), 'title' => "Reactor", 'active' => false, 'examples' => $this->examples->getDay11Examples(), 'results' => $this->gameDayPartResultIterator(11)];
        yield ['day' => $this->getReference('day_12', Day::class), 'title' => "Christmas Tree Farm", 'active' => false, 'examples' => $this->examples->getDay12Examples(), 'results' => $this->gameDayPartResultIterator(12)];
    }

    private function gameDayPartResultIterator(int $day): \Iterator
    {
        switch ($day) {
            case 1:
            case 2:
                yield ['part' => $this->getReference('dayPart_1', DayPart::class), 'solved' => true];
                yield ['part' => $this->getReference('dayPart_2', DayPart::class), 'solved' => true];
                break;
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