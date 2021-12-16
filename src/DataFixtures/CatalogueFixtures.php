<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Catalogues;
use App\Entity\Comment;

class CatalogueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create(FR_fr);

        for($i = 1; $i<10;$i++)
        {
            $catalogues = new catalogues();
            $catalogues ->setTitre("Nom du Jeu n°$i")
                        ->setDescription("<p>Description du Jeu n°$i</p>")
                        ->setImage("http://placehold.it/350x150")
                        ->setCategorie("<p>Nom de la Categorie</p>")
                        ->setDate(1)
                        ->setPrix(1)
                        ->setLienDuJeu("<p>Lien du jeu n°i</p>");
            $manager->persist($catalogues);

            for($j = 1; $j <= mt_rand(4,10); $j++){
                $comment = new \Comment();
                
                $content = '<p>' . join($faker->paragraphs(2),
                '</p><p>') . '</p>';

                $comment->setAuteur($faker->name)
                        ->setContenue($content)
                        ->setDate($faker->dateTimeBetween('6 months'))
                        ->setCatelogues($catalogues);
                $mangager->persist($comment);
            }
        }
        $manager->flush();
    }
}
