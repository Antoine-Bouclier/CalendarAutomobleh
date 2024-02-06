<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColorRepository::class)]
class Color
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $englishName = null;

    #[ORM\Column(length: 100)]
    private ?string $frenchName = null;

    #[ORM\OneToOne(mappedBy: 'color', cascade: ['persist', 'remove'])]
    private ?Employee $employee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnglishName(): ?string
    {
        return $this->englishName;
    }

    public function setEnglishName(string $englishName): static
    {
        $this->englishName = $englishName;

        return $this;
    }

    public function getFrenchName(): ?string
    {
        return $this->frenchName;
    }

    public function setFrenchName(string $frenchName): static
    {
        $this->frenchName = $frenchName;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): static
    {
        // set the owning side of the relation if necessary
        if ($employee->getColor() !== $this) {
            $employee->setColor($this);
        }

        $this->employee = $employee;

        return $this;
    }
}
