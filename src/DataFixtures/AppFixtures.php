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

        // Création des employés
        $employees = $this->getEmployee();
        foreach ($employees as $employee)
        {
            // Création de l'objet Employee
            $employeeObject = new Employee();
            $employeeObject->setName($employee['name']);
            
            // Association avec Color
            $colorRepository = $manager->getRepository(Color::class);
            $colorList = $colorRepository->findAll();
            foreach ($colorList as $color)
            {
                $colorName = $color->getEnglishName();
                if ($colorName === $employee['colorName'])
                {
                    $employeeObject->setColor($color);
                }
            }
            $manager->persist($employeeObject);
        }

        $manager->flush();
    }

    // Tableau des couleurs
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

    // Tableau des employés
    public function getEmployee() {
        return [
            [
                'name' => 'Romain',
                'colorName' => 'purple',
            ],
            [
                'name' => 'Laurent',
                'colorName' => 'blue',
            ],
            [
                'name' => 'Thierry',
                'colorName' => 'green',
            ],
            [
                'name' => 'Lucas',
                'colorName' => 'yellow',
            ],
            [
                'name' => 'Antoine',
                'colorName' => 'orange',
            ],
            [
                'name' => 'Default',
                'colorName' => 'red',
            ],
        ];
    }
}