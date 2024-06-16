<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(length: 255)]
    private ?string $make = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $vin = null;

    #[ORM\Column(length: 255)]
    private ?string $usageVehicle = null;

    #[ORM\Column(length: 255)]
    private ?string $primaryUse = null;

    #[ORM\Column]
    private ?int $annualMileage = null;

    #[ORM\Column(length: 255)]
    private ?string $ownership = null;

    /**
     * @var Collection<int, Coverage>
     */
    #[ORM\OneToMany(targetEntity: Coverage::class, mappedBy: 'vehicle', cascade: ['persist'])]
    private Collection $coverages;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $garagingAddress = null;

    #[ORM\ManyToMany(targetEntity: Policy::class, inversedBy: 'vehicles')]
    private Collection $policies;

    public function __construct() {
        $this->coverages = new ArrayCollection();
        $this->policies = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getYear(): ?int {
        return $this->year;
    }

    public function setYear(int $year): static {
        $this->year = $year;

        return $this;
    }

    public function getMake(): ?string {
        return $this->make;
    }

    public function setMake(string $make): static {
        $this->make = $make;

        return $this;
    }

    public function getModel(): ?string {
        return $this->model;
    }

    public function setModel(string $model): static {
        $this->model = $model;

        return $this;
    }

    public function getVin(): ?string {
        return $this->vin;
    }

    public function setVin(string $vin): static {
        $this->vin = $vin;

        return $this;
    }

    public function getUsageVehicle(): ?string {
        return $this->usageVehicle;
    }

    public function setUsageVehicle(string $usageVehicle): static {
        $this->usageVehicle = $usageVehicle;

        return $this;
    }

    public function getPrimaryUse(): ?string {
        return $this->primaryUse;
    }

    public function setPrimaryUse(string $primaryUse): static {
        $this->primaryUse = $primaryUse;

        return $this;
    }

    public function getAnnualMileage(): ?int {
        return $this->annualMileage;
    }

    public function setAnnualMileage(int $annualMileage): static {
        $this->annualMileage = $annualMileage;

        return $this;
    }

    public function getOwnership(): ?string {
        return $this->ownership;
    }

    public function setOwnership(string $ownership): static {
        $this->ownership = $ownership;

        return $this;
    }

    /**
     * @return Collection<int, Coverage>
     */
    public function getCoverages(): Collection {
        return $this->coverages;
    }

    public function addCoverage(Coverage $coverage): static {
        if (!$this->coverages->contains($coverage)) {
            $this->coverages->add($coverage);
            $coverage->setVehicle($this);
        }

        return $this;
    }

    public function removeCoverage(Coverage $coverage): static {
        if ($this->coverages->removeElement($coverage)) {
            // set the owning side to null (unless already changed)
            if ($coverage->getVehicle() === $this) {
                $coverage->setVehicle(null);
            }
        }

        return $this;
    }

    public function getGaragingAddress(): ?Address {
        return $this->garagingAddress;
    }

    public function setGaragingAddress(?Address $garagingAddress): static {
        $this->garagingAddress = $garagingAddress;

        return $this;
    }

    /**
     * @return Collection<int, Policy>
     */
    public function getPolicies(): Collection {
        return $this->policies;
    }

    public function addPolicy(Policy $policy): static {
        if (!$this->policies->contains($policy)) {
            $this->policies->add($policy);
            $policy->addVehicle($this);
        }

        return $this;
    }
    public function removePolicy(Policy $policy): static {
        if ($this->policies->contains($policy)) {
            $this->policies->removeElement($policy);
            $policy->removeVehicle($this);
        }
        return $this;
    }
}
