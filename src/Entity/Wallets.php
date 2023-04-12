<?php

namespace App\Entity;

use App\Repository\WalletsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WalletsRepository::class)]
class Wallets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $chain = null;

    #[ORM\Column(length: 255)]
    private ?string $master_pub_key = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creation_date = null;

    #[ORM\OneToMany(mappedBy: 'wallet', targetEntity: Address::class, orphanRemoval: true)]
    private Collection $addressid;

    #[ORM\OneToMany(mappedBy: 'sender_wallet', targetEntity: OutputTransaction::class)]
    private Collection $outputTransaction;

    #[ORM\OneToMany(mappedBy: 'wallet', targetEntity: AddressMixing::class)]
    private Collection $AddressMixing;

    public function __construct()
    {
        $this->addressid = new ArrayCollection();
        $this->outputTransaction = new ArrayCollection();
        $this->AddressMixing = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChain(): ?string
    {
        return $this->chain;
    }

    public function setChain(string $chain): self
    {
        $this->chain = $chain;

        return $this;
    }

    public function getMasterPubKey(): ?string
    {
        return $this->master_pub_key;
    }

    public function setMasterPubKey(string $master_pub_key): self
    {
        $this->master_pub_key = $master_pub_key;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

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

    /**
     * @return Collection<int, Address>
     */
    public function getAddressid(): Collection
    {
        return $this->addressid;
    }

    public function addAddressid(Address $addressid): self
    {
        if (!$this->addressid->contains($addressid)) {
            $this->addressid->add($addressid);
            $addressid->setWallet($this);
        }

        return $this;
    }

    public function removeAddressid(Address $addressid): self
    {
        if ($this->addressid->removeElement($addressid)) {
            // set the owning side to null (unless already changed)
            if ($addressid->getWallet() === $this) {
                $addressid->setWallet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OutputTransaction>
     */
    public function getOutputTransaction(): Collection
    {
        return $this->outputTransaction;
    }

    public function addOutputTransaction(OutputTransaction $outputTransaction): self
    {
        if (!$this->outputTransaction->contains($outputTransaction)) {
            $this->outputTransaction->add($outputTransaction);
            $outputTransaction->setSenderWallet($this);
        }

        return $this;
    }

    public function removeOutputTransaction(OutputTransaction $outputTransaction): self
    {
        if ($this->outputTransaction->removeElement($outputTransaction)) {
            // set the owning side to null (unless already changed)
            if ($outputTransaction->getSenderWallet() === $this) {
                $outputTransaction->setSenderWallet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AddressMixing>
     */
    public function getAddressMixing(): Collection
    {
        return $this->AddressMixing;
    }

    public function addAddressMixing(AddressMixing $addressMixing): self
    {
        if (!$this->AddressMixing->contains($addressMixing)) {
            $this->AddressMixing->add($addressMixing);
            $addressMixing->setWallet($this);
        }

        return $this;
    }

    public function removeAddressMixing(AddressMixing $addressMixing): self
    {
        if ($this->AddressMixing->removeElement($addressMixing)) {
            // set the owning side to null (unless already changed)
            if ($addressMixing->getWallet() === $this) {
                $addressMixing->setWallet(null);
            }
        }

        return $this;
    }
}
