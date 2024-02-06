<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use App\Entity\Color;
use App\Entity\Employee;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        // Création des couleurs
        $colors = $this->getColor();
        foreach ($colors as $color)
        {
            // Création de l'objet Color
            $colorobject = new Color();
            $colorobject->setEnglishName($color['englishName']);
            $colorobject->setFrenchName($color['frenchName']);
            $manager->persist($colorobject);
        }

        $manager->flush();
    }

    // table des couleurs
    public function getColor() {
        return [
            [
                'englishName' => 'red',
                'frenchName' => 'rouge',
            ],
            [
                'englishName' => 'blue',
                'frenchName' => 'bleu',
            ],
            [
                'englishName' => 'green',
                'frenchName' => 'vert',
            ],
            [
                'englishName' => 'purple',
                'frenchName' => 'violet',
            ],
            [
                'englishName' => 'yellow',
                'frenchName' => 'jaune',
            ],
            [
                'englishName' => 'orange',
                'frenchName' => 'orange',
            ],
            [
                'englishName' => 'grey',
                'frenchName' => 'gris',
            ],
            [
                'englishName' => 'pink',
                'frenchName' => 'rose',
            ],
        ];
    }
}