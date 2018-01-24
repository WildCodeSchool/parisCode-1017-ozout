<?php
/**
 * Created by PhpStorm.
 * User: cyrht
 * Date: 24/01/18
 * Time: 14:26
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker;

class UserFixtures extends Fixture

{
    public function load(ObjectManager $manager)
    {
        // initialisation de l'objet Faker
        $faker = Faker\Factory::create('fr_FR');

        // création des users
        $users = [];
        for ($i=0; $i < 20; $i++) {
            $users[$i] = new User();
            $users[$i]->setNameUser($faker->name)
                ->setSurnameUser($faker->firstName)
                ->setDateOfBirth($faker->dateTime)
                ->setUserName($faker->name)
                ->setEmail($faker->email)
                ->setpassword($faker->password)
            ;
            $manager->persist($users[$i]);

        }


//            // on récupère un nombre aléatoire de Users dans un tableau
//            $randomUsers = (array) array_rand($users, rand(1, count($users)));
//            // puis on les ajoute à Event
//            foreach ($randomUsers as $key => $value) {
//                $events[$k]->getUsers($users[$key]);
//            }
//            $manager->persist($events[$k]);


        $manager->flush();
    }

}