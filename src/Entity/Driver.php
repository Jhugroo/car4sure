<?php

namespace App\Entity;

use App\Repository\DriverRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: DriverRepository::class)]
class Driver {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 20,
        max: 35,
        notInRangeMessage: "You must be between 20-35 years old",
    )]
    private ?int $age = null;

    #[ORM\Column]
    private ?int $licenseNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $licenseState = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $licenseEffectiveDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $licenseExpirationDate = null;

    #[ORM\Column(length: 1)]
    private ?string $licenseClass = null;

    #[ORM\ManyToOne(inversedBy: 'drivers')]
    private ?Gender $gender = null;

    #[ORM\ManyToOne(inversedBy: 'drivers')]
    private ?MaritalStatus $maritalStatus = null;

    #[ORM\ManyToMany(targetEntity: Policy::class, inversedBy: 'drivers')]
    private Collection $policies;

    public function __construct() {
        $this->policies = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAge(): ?int {
        return $this->age;
    }

    public function setAge(int $age): static {
        $this->age = $age;

        return $this;
    }

    public function getLicenseNumber(): ?int {
        return $this->licenseNumber;
    }

    public function setLicenseNumber(int $licenseNumber): static {
        $this->licenseNumber = $licenseNumber;

        return $this;
    }

    public function getLicenseState(): ?string {
        return $this->licenseState;
    }

    public function setLicenseState(string $licenseState): static {
        $this->licenseState = $licenseState;

        return $this;
    }

    public function getLicenseEffectiveDate(): ?\DateTimeInterface {
        return $this->licenseEffectiveDate;
    }

    public function setLicenseEffectiveDate(\DateTimeInterface $licenseEffectiveDate): static {
        $this->licenseEffectiveDate = $licenseEffectiveDate;

        return $this;
    }

    public function getLicenseExpirationDate(): ?\DateTimeInterface {
        return $this->licenseExpirationDate;
    }

    public function setLicenseExpirationDate(\DateTimeInterface $licenseExpirationDate): static {
        $this->licenseExpirationDate = $licenseExpirationDate;

        return $this;
    }

    public function getLicenseClass(): ?string {
        return $this->licenseClass;
    }

    public function setLicenseClass(string $licenseClass): static {
        $this->licenseClass = $licenseClass;

        return $this;
    }

    public function getGender(): ?Gender {
        return $this->gender;
    }

    public function setGender(?Gender $gender): static {
        $this->gender = $gender;

        return $this;
    }

    public function getMaritalStatus(): ?MaritalStatus {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(?MaritalStatus $maritalStatus): static {
        $this->maritalStatus = $maritalStatus;

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
            $policy->addDriver($this);
        }

        return $this;
    }
    public function removePolicy(Policy $policy): static {
        if ($this->policies->contains($policy)) {
            $this->policies->removeElement($policy);
            $policy->removeDriver($this);
        }
        return $this;
    }
}
