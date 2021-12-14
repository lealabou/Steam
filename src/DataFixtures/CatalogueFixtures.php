<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Catalogues;

class CatalogueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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

        }
        $manager->flush();
    }
}
