<?php

namespace App\DataFixtures;

use App\Entity\Tour;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

;

class TourFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $tour = new Tour();

        $tour->setName('Tour to Marrackech');
        $tour->setPrice(63);
        $tour->setLocation('Marrackech');
        $tour->setDay(2);
        $tour->setOnline(1);

        $manager->persist($tour);
        $manager->flush();
    }
}
