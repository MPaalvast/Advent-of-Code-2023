<?php

namespace App\DataFixtures;

use App\DataFixtures\DayExamples\DayExamples2017;
use App\Entity\Day;
use App\Entity\DayPart;
use App\Entity\Year;
use App\Model\StatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Config2017Fixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly FixtureService $fixtureService,
        private readonly DayExamples2017 $examples,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $year = new Year();
        $year->setTitle('2017');
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
        yield ['day' => $this->getReference('day_1', Day::class), 'title' => "Inverse Captcha", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay1Examples(), 'results' => $this->gameDayPartResultIterator(1)];
        yield ['day' => $this->getReference('day_2', Day::class), 'title' => "Corruption Checksum", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay2Examples(), 'results' => $this->gameDayPartResultIterator(2)];
        yield ['day' => $this->getReference('day_3', Day::class), 'title' => "Spiral Memory", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay3Examples(), 'results' => $this->gameDayPartResultIterator(3)];
        yield ['day' => $this->getReference('day_4', Day::class), 'title' => "High-Entropy Passphrases", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay4Examples(), 'results' => $this->gameDayPartResultIterator(4)];
        yield ['day' => $this->getReference('day_5', Day::class), 'title' => "A Maze of Twisty Trampolines, All Alike", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay5Examples(), 'results' => $this->gameDayPartResultIterator(5)];
        yield ['day' => $this->getReference('day_6', Day::class), 'title' => "Memory Reallocation", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay6Examples(), 'results' => $this->gameDayPartResultIterator(6)];
        yield ['day' => $this->getReference('day_7', Day::class), 'title' => "Recursive Circus", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay7Examples(), 'results' => $this->gameDayPartResultIterator(7)];
        yield ['day' => $this->getReference('day_8', Day::class), 'title' => "I Heard You Like Registers", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay8Examples(), 'results' => $this->gameDayPartResultIterator(8)];
        yield ['day' => $this->getReference('day_9', Day::class), 'title' => "Stream Processing", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay9Examples(), 'results' => $this->gameDayPartResultIterator(9)];
        yield ['day' => $this->getReference('day_10', Day::class), 'title' => "Knot Hash", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay10Examples(), 'results' => $this->gameDayPartResultIterator(10)];
        yield ['day' => $this->getReference('day_11', Day::class), 'title' => "Hex Ed", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay11Examples(), 'results' => $this->gameDayPartResultIterator(11)];
        yield ['day' => $this->getReference('day_12', Day::class), 'title' => "Digital Plumber", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay12Examples(), 'results' => $this->gameDayPartResultIterator(12)];
        yield ['day' => $this->getReference('day_13', Day::class), 'title' => "Packet Scanners", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay13Examples(), 'results' => $this->gameDayPartResultIterator(13)];
        yield ['day' => $this->getReference('day_14', Day::class), 'title' => "Disk Defragmentation", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay14Examples(), 'results' => $this->gameDayPartResultIterator(14)];
        yield ['day' => $this->getReference('day_15', Day::class), 'title' => "Dueling Generators", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay15Examples(), 'results' => $this->gameDayPartResultIterator(15)];
        yield ['day' => $this->getReference('day_16', Day::class), 'title' => "Permutation Promenade", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay16Examples(), 'results' => $this->gameDayPartResultIterator(16)];
        yield ['day' => $this->getReference('day_17', Day::class), 'title' => "Spinlock", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay17Examples(), 'results' => $this->gameDayPartResultIterator(17)];
        yield ['day' => $this->getReference('day_18', Day::class), 'title' => "Duet", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay18Examples(), 'results' => $this->gameDayPartResultIterator(18)];
        yield ['day' => $this->getReference('day_19', Day::class), 'title' => "A Series of Tubes", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay19Examples(), 'results' => $this->gameDayPartResultIterator(19)];
        yield ['day' => $this->getReference('day_20', Day::class), 'title' => "Particle Swarm", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay20Examples(), 'results' => $this->gameDayPartResultIterator(20)];
        yield ['day' => $this->getReference('day_21', Day::class), 'title' => "Fractal Art", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay21Examples(), 'results' => $this->gameDayPartResultIterator(21)];
        yield ['day' => $this->getReference('day_22', Day::class), 'title' => "Sporifica Virus", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay22Examples(), 'results' => $this->gameDayPartResultIterator(22)];
        yield ['day' => $this->getReference('day_23', Day::class), 'title' => "Coprocessor Conflagration", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay23Examples(), 'results' => $this->gameDayPartResultIterator(23)];
        yield ['day' => $this->getReference('day_24', Day::class), 'title' => "Electromagnetic Moat", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay24Examples(), 'results' => $this->gameDayPartResultIterator(24)];
        yield ['day' => $this->getReference('day_25', Day::class), 'title' => "The Halting Problem", 'status' => StatusEnum::INACTIVE, 'examples' => $this->examples->getDay25Examples(), 'results' => $this->gameDayPartResultIterator(25)];
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
