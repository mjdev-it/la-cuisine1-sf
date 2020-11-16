<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecetteFixtures extends Fixture
{
 
    public function load(ObjectManager $manager){
        $faker = \Faker\Factory::create("fr_FR");

        // Creer 3 categories fakées
        for($i=1; $i<=3; $i++){
            
            $categorie = new Category();
            $categorie->setTitle($faker->words($nb = 5, $asText = true)   )
                        ->setDescription($faker->paragraphs($nb = 2, $asText = true) );

            $manager->persist($categorie);

            $content = "<p>" . join($faker->paragraphs($nb = 3, $asText = false)) . "</p>";
        
            // creer entre 4 et 6 recettes
            for($j=1 ; $j <= mt_rand(4, 6); $j++){
                $recette = new Recette();
                $recette->setTitle($faker->paragraphs($nb = 4, $asText = false))
                        ->setContent($content)
                        ->setImage($faker->imageUrl($width = 640, $height = 480))
                        ->setCreatedAt($faker->dateTimeBetween("- 6 months"))
                        ->setCategory($categorie);
                $manager->persist($recette);

                // creer entre 1 et 10 commentaires
                for($k=1 ; $k <= mt_rand(1, 10); $k++){
                    $comment = new Comment();
                    $content = "<p>" . join($faker->paragraphs($nb = 3, $asText = false)) . "</p>";

                    $now = new \DateTime();
                    $interval = $now->diff($recette->getCreatedAt());
                    $interval = $interval->days;
                    $minimum = "- " . $interval . " days"; // exemple -100 days
                    /* ce qui peut s'ecrire aussi
                    $days = (new \DateTime())->diff($recette->getCreatedAt())->days
                     et alors on peut remplacer $minimum ci-dessous par $days */

                    $comment->setAuthor($faker->name)
                            ->setContent($content)
                            ->setCreatedAt($faker->dateTimeBetween("$minimum"))
                            ->setRecette($recette);
                    $manager->persist($comment);

                }
            }
            $manager->flush();
        }   
    }
}
