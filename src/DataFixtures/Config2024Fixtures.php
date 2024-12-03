<?php

namespace App\DataFixtures;

use App\Entity\GameDay;
use App\Entity\Year;
use App\Model\StatusEnum;
use App\Repository\DayRepository;
use App\Service\Tools\FileOptions;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Config2024Fixtures extends Fixture
{
    public function __construct(
        private readonly FileOptions $fileOptions,
        private readonly FixtureService $fixtureService
    ) {
    }

    public function load(ObjectManager $manager): void
    {

        $year = new Year();
        $year->setTitle('2024');
        $manager->persist($year);

        $gameDays = $this->gameDayIterator();
        $this->fixtureService->makeGameDays($manager, $year, $gameDays);

        $manager->flush();
    }

    private function gameDayIterator(): \Iterator
    {
        yield ['day' => '1', 'title' => "Historian Hysteria", 'status' => StatusEnum::ACTIVE];
        yield ['day' => '2', 'title' => "Red-Nosed Reports", 'status' => StatusEnum::ACTIVE];
        yield ['day' => '3', 'title' => "Mull It Over", 'status' => StatusEnum::ACTIVE];
//        yield ['day' => '4', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '5', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '6', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '7', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '8', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '9', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '10', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '11', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '12', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '13', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '14', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '15', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '16', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '17', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '18', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '19', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '20', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '21', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '22', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '23', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '24', 'title' => "", 'status' => StatusEnum::INACTIVE];
//        yield ['day' => '25', 'title' => "", 'status' => StatusEnum::INACTIVE];
    }

    private function getInputArray(): array
    {

    }

    public static function getGroups(): array
    {
        return ['2024'];
    }
}
