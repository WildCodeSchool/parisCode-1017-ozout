<?php
/**
 * Created by PhpStorm.
 * User: cyrht
 * Date: 24/01/18
 * Time: 22:12
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Category;
use AppBundle\Entity\Event;
use AppBundle\Entity\Review;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker;

class LoadData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // initialisation de l'objet Faker
        $faker = Faker\Factory::create('fr_FR');

        // creations des categories
        $categories = [
            'Concert',
            'Anniversaire',
            'Pendaison de crémaillère',
            'Pot de départ',
            'Mariage',
            'EVG/EVJF',
            'Weekend',
            'Soirée',
            'Projets',
            'Naissance',
            'Remerciements',
            'Sport',
            'Autres'
            ,        ];
        foreach ($categories as $nameCategory){
            $category = new Category();
            $category->setNameCategory($nameCategory);
            $manager->persist($category);
        }

        // création des users
        $users = [];
        for ($i=0; $i < 20; $i++) {
            $users[$i] = new User();
            $users[$i]->setNameUser($faker->name)
                ->setSurnameUser($faker->firstName)
                ->setDateOfBirth($faker->dateTime)
                ->setUserName($faker->lastName)
                ->setEmail($faker->email)
                ->setpassword($faker->password);

            $manager->persist($users[$i]);
        }

        // création des reviews
        $reviews = [];
        for ($j = 0; $j < 20; $j++) {
            $reviews[$j] = new Review();
            $reviews[$j]->setComment($faker->text)
                ->setScore($faker->numberBetween($min = 0, $max = 5));

            $manager->persist($reviews[$j]);

        }

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
                ->getCategory()
                ;


            // on récupère un nombre aléatoire de Reviews dans un tableau
            $randomReviews = (array)array_rand($reviews, rand(1, count($reviews)));
            // puis on les ajoute à Event
            foreach ($randomReviews as $key => $value) {
                $events[$k]->addReview($reviews[$key]);
            }

            // on récupère un nombre aléatoire de Categories dans un tableau
            $randomCategories = (array)array_rand($categories, rand(1, count($categories)));
            // puis on les ajoute à Event
            foreach ($randomCategories as $key => $value) {
                $events[$k]->getCategory($categories[$key]);
            }

            $manager->persist($events[$k]);
        }

        $manager->flush();

    }
}