<?php
/**
 * Created by PhpStorm.
 * User: cyrht
 * Date: 24/01/18
 * Time: 17:51
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker;

class EventFixtures extends Fixture

{
    public function load(ObjectManager $manager)
    {
        // initialisation de l'objet Faker
        $faker = Faker\Factory::create('fr_FR');

        // création des events
        $events = [];
        for ($k=0; $k < 20; $k++) {
            $events[$k] = new Event();
            $events[$k]
                ->setTitle($faker->sentence($nbWords = 5, $variableNbWords = true))
                ->setAdress($faker->address)
                ->setCity($faker->city)
                ->setZipcode($faker->postcode)
                ->setTargetMoney($faker->numberBetween($min = 1, $max = 90000))
                ->setEventDescription($faker->text($maxNbChars = 300))
            ;
            $manager->persist($events[$k]);

        }
        $manager->flush();
    }
}