<?php

namespace App\DataFixtures;

use App\Entity\Vegetable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VegetableFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i <= 10; $i++) {
            $vegetable = new Vegetable();
            $vegetable->setName($faker->name);
        }

        $manager->flush();
    }
}
