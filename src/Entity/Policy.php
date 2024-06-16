<?php

namespace App\Entity;

use App\Repository\PolicyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PolicyRepository::class)]
class Policy {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $policyNo = null;

    #[ORM\Column(length: 255)]
    private ?string $policyStatus = null;

    #[ORM\Column(length: 255)]
    private ?string $policyType = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $policyEffectiveDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $policyExpirationDate = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?PolicyHolder $policyHolder = null;


    /**
     * @var Collection<int, Driver>
     */
    #[ORM\ManyToMany(targetEntity: Driver::class, mappedBy: 'policies')]
    private Collection $drivers;

    /**
     * @var Collection<int, Vehicle>
     */
    #[ORM\ManyToMany(targetEntity: Vehicle::class, mappedBy: 'policies')]
    private Collection $vehicles;

    public function __construct() {
        $this->drivers = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
    }



    public function getId(): ?int {
        return $this->id;
    }

    public function getPolicyNo(): ?int {
        return $this->policyNo;
    }

    public function setPolicyNo(int $policyNo): static {
        $this->policyNo = $policyNo;

        return $this;
    }

    public function getPolicyStatus(): ?string {
        return $this->policyStatus;
    }

    public function setPolicyStatus(string $policyStatus): static {
        $this->policyStatus = $policyStatus;

        return $this;
    }

    public function getPolicyType(): ?string {
        return $this->policyType;
    }

    public function setPolicyType(string $policyType): static {
        $this->policyType = $policyType;

        return $this;
    }

    public function getPolicyEffectiveDate(): ?\DateTimeInterface {
        return $this->policyEffectiveDate;
    }

    public function setPolicyEffectiveDate(\DateTimeInterface $policyEffectiveDate): static {
        $this->policyEffectiveDate = $policyEffectiveDate;

        return $this;
    }

    public function getPolicyExpirationDate(): ?\DateTimeInterface {
        return $this->policyExpirationDate;
    }

    public function setPolicyExpirationDate(\DateTimeInterface $policyExpirationDate): static {
        $this->policyExpirationDate = $policyExpirationDate;

        return $this;
    }

    public function getPolicyHolder(): ?PolicyHolder {
        return $this->policyHolder;
    }

    public function setPolicyHolder(?PolicyHolder $policyHolder): static {
        $this->policyHolder = $policyHolder;

        return $this;
    }

    /**
     * @return Collection<int, Driver>
     */
    public function getDrivers(): Collection {
        return $this->drivers;
    }

    public function addDriver(Driver $driver): static {

        if (!$this->drivers->contains($driver)) {
            $this->drivers[] = $driver;
            $driver->addPolicy($this);
        }
        return $this;
    }

    public function removeDriver(Driver $driver): static {
        if ($this->drivers->contains($driver)) {
            $this->drivers->removeElement($driver);
            $driver->removePolicy($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getVehicles(): Collection {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): static {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles[] = $vehicle;
            $vehicle->addPolicy($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): static {
        if ($this->vehicles->contains($vehicle)) {
            $this->vehicles->removeElement($vehicle);
            $vehicle->removePolicy($this);
        }

        return $this;
    }
}
