<?php

namespace App\DataFixtures;

use App\Entity\Day;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Day12Fixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 12; $i++) {
            $day = new Day();
            $day->setTitle($i);
            $this->addReference('day_'.$i, $day);
            $manager->persist($day);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 99;
    }
}