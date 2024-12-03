<?php

namespace App\DataFixtures;

use App\Entity\GameDay;
use App\Entity\Year;
use App\Model\StatusEnum;
use App\Repository\DayRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class Config2023Fixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(
        private readonly FixtureService $fixtureService
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $year = new Year();
        $year->setTitle('2023');
        $manager->persist($year);

        $gameDays = $this->gameDayIterator();
        $this->fixtureService->makeGameDays($manager, $year, $gameDays);

        $manager->flush();
    }

    private function gameDayIterator(): \Iterator
    {
        yield ['day' => '1', 'title' => "Trebuchet?!", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '2', 'title' => "Cube Conundrum", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '3', 'title' => "Gear Ratios", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '4', 'title' => "Scratchcards", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '5', 'title' => "If You Give A Seed A Fertilizer", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '6', 'title' => "Wait For It", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '7', 'title' => "Camel Cards", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '8', 'title' => "Haunted Wasteland", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '9', 'title' => "Mirage Maintenance", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '10', 'title' => "Pipe Maze", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '11', 'title' => "Cosmic Expansion", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '12', 'title' => "Hot Springs", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '13', 'title' => "Point of Incidence", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '14', 'title' => "Parabolic Reflector Dish", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '15', 'title' => "Lens Library", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '16', 'title' => "The Floor Will Be Lava", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '17', 'title' => "Clumsy Crucible", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '18', 'title' => "Lavaduct Lagoon", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '19', 'title' => "Aplenty", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '20', 'title' => "Pulse Propagation", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '21', 'title' => "Step Counter", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '22', 'title' => "Sand Slabs", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '23', 'title' => "A Long Walk", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '24', 'title' => "Never Tell Me The Odds", 'status' => StatusEnum::INACTIVE];
        yield ['day' => '25', 'title' => "Snowverload", 'status' => StatusEnum::INACTIVE];
    }

    public static function getGroups(): array
    {
        return ['2023'];
    }
}
