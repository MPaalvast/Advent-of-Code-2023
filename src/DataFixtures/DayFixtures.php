<?php

namespace App\DataFixtures;

use App\Entity\Day;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class DayFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 25; $i++) {
            $day = new Day();
            $day->setTitle($i);
            $manager->persist($day);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['init'];
    }
}
