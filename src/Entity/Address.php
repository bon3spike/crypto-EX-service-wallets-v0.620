<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?bool $multiple = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creation_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $last_usage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $derivation_path = null;

    #[ORM\ManyToOne(inversedBy: 'addressid')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Wallets $wallet = null;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: Currency::class, orphanRemoval: true)]
    private Collection $currency;

    public function __construct()
    {
        $this->currency = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function isMultiple(): ?bool
    {
        return $this->multiple;
    }

    public function setMultiple(bool $multiple): self
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getLastUsage(): ?\DateTimeInterface
    {
        return $this->last_usage;
    }

    public function setLastUsage(?\DateTimeInterface $last_usage): self
    {
        $this->last_usage = $last_usage;

        return $this;
    }

    public function getDerivationPath(): ?string
    {
        return $this->derivation_path;
    }

    public function setDerivationPath(?string $derivation_path): self
    {
        $this->derivation_path = $derivation_path;

        return $this;
    }

    public function getWallet(): ?Wallets
    {
        return $this->wallet;
    }

    public function setWallet(?Wallets $wallet): self
    {
        $this->wallet = $wallet;

        return $this;
    }

    /**
     * @return Collection<int, Currency>
     */
    public function getCurrency(): Collection
    {
        return $this->currency;
    }

    public function addCurrency(Currency $currency): self
    {
        if (!$this->currency->contains($currency)) {
            $this->currency->add($currency);
            $currency->setAddress($this);
        }

        return $this;
    }

    public function removeCurrency(Currency $currency): self
    {
        if ($this->currency->removeElement($currency)) {
            // set the owning side to null (unless already changed)
            if ($currency->getAddress() === $this) {
                $currency->setAddress(null);
            }
        }

        return $this;
    }
}
