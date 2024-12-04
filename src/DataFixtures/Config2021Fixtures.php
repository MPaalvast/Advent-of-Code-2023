<?php

namespace App\DataFixtures;

use App\Entity\Day;
use App\Entity\DayPart;
use App\Entity\Year;
use App\Model\StatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Config2021Fixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function __construct(
        private readonly FixtureService $fixtureService
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $year = new Year();
        $year->setTitle('2021');
        $year->setStatus(StatusEnum::ACTIVE);
        $manager->persist($year);

//        $gameDays = $this->gameDayIterator();
//        $dayParts = [
//            1 => $this->getReference('dayPart_1', DayPart::class),
//            2 => $this->getReference('dayPart_2', DayPart::class),
//        ];
//        $this->fixtureService->makeGameDays($manager, $year, $gameDays, $dayParts);

        $manager->flush();
    }

    private function gameDayIterator(): \Iterator
    {
        yield ['day' => $this->getReference('day_1', Day::class), 'title' => "Sonar Sweep", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_2', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_3', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_4', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_5', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_6', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_7', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_8', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_9', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_10', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_11', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_12', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_13', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_14', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_15', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_16', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_17', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_18', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_19', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_20', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_21', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_22', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_23', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_24', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => $this->getReference('day_25', Day::class), 'title' => "", 'status' => StatusEnum::INACTIVE];
    }

    public static function getGroups(): array
    {
        return ['2021'];
    }

    public function getDependencies(): array
    {
        return [
            DayFixtures::class
        ];
    }
}
