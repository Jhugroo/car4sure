<?php

namespace App\Entity;

use App\Repository\MaritalStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaritalStatusRepository::class)]
class MaritalStatus {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Driver>
     */
    #[ORM\OneToMany(targetEntity: Driver::class, mappedBy: 'maritalStatus')]
    private Collection $drivers;

    public function __construct() {
        $this->drivers = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): static {
        $this->name = $name;

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
            $this->drivers->add($driver);
            $driver->setMaritalStatus($this);
        }

        return $this;
    }

    public function removeDriver(Driver $driver): static {
        if ($this->drivers->removeElement($driver)) {
            // set the owning side to null (unless already changed)
            if ($driver->getMaritalStatus() === $this) {
                $driver->setMaritalStatus(null);
            }
        }

        return $this;
    }
}
