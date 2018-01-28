<?php

/**
 * Created by PhpStorm.
 * User: cyrht
 * Date: 10/01/18
 * Time: 16:25
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create categories.
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

        $manager->flush();
    }
}