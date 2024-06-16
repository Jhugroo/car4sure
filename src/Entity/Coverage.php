<?php

namespace App\Entity;

use App\Repository\CoverageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoverageRepository::class)]
class Coverage {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $limitCoverage = null;

    #[ORM\Column]
    private ?int $deductible = null;



    #[ORM\ManyToOne(inversedBy: 'coverages')]
    private ?Vehicle $vehicle = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(string $type): static {
        $this->type = $type;

        return $this;
    }

    public function getLimitCoverage(): ?int {
        return $this->limitCoverage;
    }

    public function setLimitCoverage(int $limitCoverage): static {
        $this->limitCoverage = $limitCoverage;

        return $this;
    }

    public function getDeductible(): ?int {
        return $this->deductible;
    }

    public function setDeductible(int $deductible): static {
        $this->deductible = $deductible;

        return $this;
    }

    public function getVehicle(): ?Vehicle {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): static {
        $this->vehicle = $vehicle;

        return $this;
    }
}
