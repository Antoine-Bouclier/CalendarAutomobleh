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
            $colorobject->setCreatedAt(new DateTimeImmutable($color['created_at']));
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
            $employeeObject->setCreatedAt(new DateTimeImmutable($employee['created_at']));
            
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
                'created_at' => '2023-02-07',
            ],
            [
                'englishName' => 'blue',
                'frenchName' => 'bleu',
                'created_at' => '2023-02-07',
            ],
            [
                'englishName' => 'green',
                'frenchName' => 'vert',
                'created_at' => '2023-02-07',
            ],
            [
                'englishName' => 'purple',
                'frenchName' => 'violet',
                'created_at' => '2023-02-07',
            ],
            [
                'englishName' => 'yellow',
                'frenchName' => 'jaune',
                'created_at' => '2023-02-07',
            ],
            [
                'englishName' => 'orange',
                'frenchName' => 'orange',
                'created_at' => '2023-02-07',
            ],
            [
                'englishName' => 'grey',
                'frenchName' => 'gris',
                'created_at' => '2023-02-07',
            ],
            [
                'englishName' => 'pink',
                'frenchName' => 'rose',
                'created_at' => '2023-02-07',
            ],
        ];
    }

    // Tableau des employés
    public function getEmployee() {
        return [
            [
                'name' => 'Romain',
                'colorName' => 'purple',
                'created_at' => '2023-02-07',
            ],
            [
                'name' => 'Laurent',
                'colorName' => 'blue',
                'created_at' => '2023-02-07',
            ],
            [
                'name' => 'Thierry',
                'colorName' => 'green',
                'created_at' => '2023-02-07',
            ],
            [
                'name' => 'Lucas',
                'colorName' => 'yellow',
                'created_at' => '2023-02-07',
            ],
            [
                'name' => 'Antoine',
                'colorName' => 'orange',
                'created_at' => '2023-02-07',
            ],
            [
                'name' => 'Default',
                'colorName' => 'red',
                'created_at' => '2023-02-07',
            ],
        ];
    }
}