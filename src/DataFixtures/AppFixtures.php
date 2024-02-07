<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use App\Entity\Color;
use App\Entity\Employee;
use DateTime;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        // Date du jour
        $today = date('Y-m-d G:i:s');

        // $tomorrow = date("Y-m-d 10:00:00", strtotime("+1 day"));

        // Création des couleurs
        $colors = $this->getColor();
        foreach ($colors as $color)
        {
            // Création de l'objet Color
            $colorobject = new Color();
            $colorobject->setEnglishName($color['englishName']);
            $colorobject->setFrenchName($color['frenchName']);
            $colorobject->setCreatedAt(new DateTimeImmutable($today));
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
            $employeeObject->setCreatedAt(new DateTimeImmutable($today));
            
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

        // Création des bookings
        $bookings = $this->getBooking();
        foreach ($bookings as $booking)
        {
            // Création de l'objet Booking
            $bookingObject = new Booking();
            $bookingObject->setTitle($booking['title']);
            $bookingObject->setBeginAt(new DateTime($booking['begin_at']));
            $bookingObject->setEndAt(new DateTime($booking['end_at']));
            $bookingObject->setCreatedAt(new DateTimeImmutable($today));

            $manager->persist($bookingObject);
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

    // Création des bookings
    public function getBooking()
    {
        return [
            [
                'begin_at' => date("Y-m-d 10:00:00", strtotime("+1 day")),
                'end_at' => date("Y-m-d 11:00:00", strtotime("+1 day")),
                'title' => 'Vidange',
            ],
            [
                'begin_at' => date("Y-m-d 14:00:00", strtotime("+1 day")),
                'end_at' => date("Y-m-d 16:00:00", strtotime("+1 day")),
                'title' => 'Revision',
            ],
            [
                'begin_at' => date("Y-m-d 08:00:00", strtotime("-1 day")),
                'end_at' => date("Y-m-d 10:00:00", strtotime("-1 day")),
                'title' => 'Vidange',
            ],
            [
                'begin_at' => date("Y-m-d 10:00:00", strtotime("-1 day")),
                'end_at' => date("Y-m-d 11:00:00", strtotime("-1 day")),
                'title' => 'Changement pièce',
            ],
            [
                'begin_at' => date("Y-m-d 09:00:00", strtotime("-2 day")),
                'end_at' => date("Y-m-d 11:00:00", strtotime("-2 day")),
                'title' => 'Changement pneu',
            ],
            [
                'begin_at' => date("Y-m-d 10:00:00"),
                'end_at' => date("Y-m-d 12:00:00"),
                'title' => 'Changement pneu',
            ],
            [
                'begin_at' => date("Y-m-d 14:00:00"),
                'end_at' => date("Y-m-d 16:00:00"),
                'title' => 'Entretien',
            ],
            [
                'begin_at' => date("Y-m-d 08:00:00"),
                'end_at' => date("Y-m-d 11:00:00"),
                'title' => 'Changement pneu',
            ],
            [
                'begin_at' => date("Y-m-d 10:00:00", strtotime("+2 day")),
                'end_at' => date("Y-m-d 12:00:00", strtotime("+2 day")),
                'title' => 'Changement pièce',
            ],
            [
                'begin_at' => date("Y-m-d 09:00:00", strtotime("+2 day")),
                'end_at' => date("Y-m-d 11:00:00", strtotime("+2 day")),
                'title' => 'Changement plaquette de frein',
            ],
        ];
    }
}