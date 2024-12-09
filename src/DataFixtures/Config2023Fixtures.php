<?php

namespace App\DataFixtures;

use App\DataFixtures\DayExamples\DayExamples2023;
use App\Entity\Day;
use App\Entity\DayPart;
use App\Entity\Year;
use App\Model\StatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Config2023Fixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly FixtureService $fixtureService,
        private readonly DayExamples2023 $examples,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $year = new Year();
        $year->setTitle('2023');
        $year->setStatus(StatusEnum::ACTIVE);
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
        yield ['day' => $this->getReference('day_1', Day::class), 'title' => "Trebuchet?!", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay1Examples()];
        yield ['day' => $this->getReference('day_2', Day::class), 'title' => "Cube Conundrum", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay2Examples()];
        yield ['day' => $this->getReference('day_3', Day::class), 'title' => "Gear Ratios", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay3Examples()];
        yield ['day' => $this->getReference('day_4', Day::class), 'title' => "Scratchcards", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay4Examples()];
        yield ['day' => $this->getReference('day_5', Day::class), 'title' => "If You Give A Seed A Fertilizer", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay5Examples()];
        yield ['day' => $this->getReference('day_6', Day::class), 'title' => "Wait For It", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay6Examples()];
        yield ['day' => $this->getReference('day_7', Day::class), 'title' => "Camel Cards", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay6Examples()];
        yield ['day' => $this->getReference('day_8', Day::class), 'title' => "Haunted Wasteland", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay8Examples()];
        yield ['day' => $this->getReference('day_9', Day::class), 'title' => "Mirage Maintenance", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay9Examples()];
        yield ['day' => $this->getReference('day_10', Day::class), 'title' => "Pipe Maze", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay10Examples()];
        yield ['day' => $this->getReference('day_11', Day::class), 'title' => "Cosmic Expansion", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay11Examples()];
        yield ['day' => $this->getReference('day_12', Day::class), 'title' => "Hot Springs", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay12Examples()];
        yield ['day' => $this->getReference('day_13', Day::class), 'title' => "Point of Incidence", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay13Examples()];
        yield ['day' => $this->getReference('day_14', Day::class), 'title' => "Parabolic Reflector Dish", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay14Examples()];
        yield ['day' => $this->getReference('day_15', Day::class), 'title' => "Lens Library", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay15Examples()];
        yield ['day' => $this->getReference('day_16', Day::class), 'title' => "The Floor Will Be Lava", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay16Examples()];
        yield ['day' => $this->getReference('day_17', Day::class), 'title' => "Clumsy Crucible", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay17Examples()];
        yield ['day' => $this->getReference('day_18', Day::class), 'title' => "Lavaduct Lagoon", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay18Examples()];
        yield ['day' => $this->getReference('day_19', Day::class), 'title' => "Aplenty", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay19Examples()];
        yield ['day' => $this->getReference('day_20', Day::class), 'title' => "Pulse Propagation", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay20Examples()];
        yield ['day' => $this->getReference('day_21', Day::class), 'title' => "Step Counter", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay21Examples()];
        yield ['day' => $this->getReference('day_22', Day::class), 'title' => "Sand Slabs", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay22Examples()];
        yield ['day' => $this->getReference('day_23', Day::class), 'title' => "A Long Walk", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay23Examples()];
        yield ['day' => $this->getReference('day_24', Day::class), 'title' => "Never Tell Me The Odds", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay24Examples()];
        yield ['day' => $this->getReference('day_25', Day::class), 'title' => "Snowverload", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay25Examples()];
    }

    public function getDependencies(): array
    {
        return [
            DayFixtures::class
        ];
    }
}
