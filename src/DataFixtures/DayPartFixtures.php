<?php

namespace App\DataFixtures;

use App\Entity\DayPart;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DayPartFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 2; $i++) {
            $dayPart = new DayPart();
            $dayPart->setTitle($i);
            $this->addReference('dayPart_'.$i, $dayPart);
            $manager->persist($dayPart);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 98;
    }
}
