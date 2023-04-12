<?php

namespace App\Entity;

use App\Repository\MixOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MixOrderRepository::class)]
class MixOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address_of_service = null;

    #[ORM\Column]
    private ?int $wallet_of_service = null;

    #[ORM\Column(length: 255)]
    private ?string $currency_to_mix = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column]
    private ?string $status = null;

    #[ORM\Column]
    private ?float $commission_persents = null;

    #[ORM\Column]
    private ?float $commission_of_risk_for_sending = null;

    #[ORM\Column]
    private ?bool $recieve_btc_b = null;

    #[ORM\Column]
    private ?float $commission_of_risk_of_recieving = null;

    #[ORM\Column]
    private ?float $comission_of_service = null;

    #[ORM\Column]
    private ?bool $low_risk = null;

    #[ORM\Column(length: 10)]
    private ?string $mix_code = null;

    #[ORM\Column]
    private ?float $amount_to_send = null;

    #[ORM\Column]
    private ?bool $over_max = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $letter_of_guarantee_uri = null;

    #[ORM\OneToMany(mappedBy: 'mixorder', targetEntity: InputTransaction::class)]
    private Collection $inputTransaction;

    #[ORM\OneToMany(mappedBy: 'mixorder', targetEntity: OutputTransaction::class)]
    private Collection $outputTransaction;

    #[ORM\OneToMany(mappedBy: 'mixorder', targetEntity: AddressMixing::class)]
    private Collection $AddressMixingId;

    #[ORM\OneToOne(mappedBy: 'mixorder', cascade: ['persist', 'remove'])]
    private ?MixingCode $MixingCodeRelation = null;

    public function __construct()
    {
        $this->inputTransaction = new ArrayCollection();
        $this->outputTransaction = new ArrayCollection();
        $this->AddressMixingId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressOfService(): ?string
    {
        return $this->address_of_service;
    }

    public function setAddressOfService(string $address_of_service): self
    {
        $this->address_of_service = $address_of_service;

        return $this;
    }

    public function getWalletOfService(): ?int
    {
        return $this->wallet_of_service;
    }

    public function setWalletOfService(int $wallet_of_service): self
    {
        $this->wallet_of_service = $wallet_of_service;

        return $this;
    }

    public function getCurrencyToMix(): ?string
    {
        return $this->currency_to_mix;
    }

    public function setCurrencyToMix(string $currency_to_mix): self
    {
        $this->currency_to_mix = $currency_to_mix;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function isRecieveBtcB(): ?bool
    {
        return $this->recieve_btc_b;
    }

    public function setRecieveBtcB(bool $recieve_btc_b): self
    {
        $this->recieve_btc_b = $recieve_btc_b;

        return $this;
    }

    public function getCommissionPersents(): ?float
    {
        return $this->commission_persents;
    }

    public function setCommissionPersents(float $commission_persents): self
    {
        $this->commission_persents = $commission_persents;

        return $this;
    }

    public function getCommissionOfRiskForSending(): ?float
    {
        return $this->commission_of_risk_for_sending;
    }

    public function setCommissionOfRiskForSending(float $commission_of_risk_for_sending): self
    {
        $this->commission_of_risk_for_sending = $commission_of_risk_for_sending;

        return $this;
    }

    public function getCommissionOfRiskOfRecieving(): ?float
    {
        return $this->commission_of_risk_of_recieving;
    }

    public function setCommissionOfRiskOfRecieving(float $commission_of_risk_of_recieving): self
    {
        $this->commission_of_risk_of_recieving = $commission_of_risk_of_recieving;

        return $this;
    }

    public function getComissionOfService(): ?float
    {
        return $this->comission_of_service;
    }

    public function setComissionOfService(float $comission_of_service): self
    {
        $this->comission_of_service = $comission_of_service;

        return $this;
    }

    public function isLowRisk(): ?bool
    {
        return $this->low_risk;
    }

    public function setLowRisk(bool $low_risk): self
    {
        $this->low_risk = $low_risk;

        return $this;
    }

    public function getMixCode(): ?string
    {
        return $this->mix_code;
    }

    public function setMixCode(string $mix_code): self
    {
        $this->mix_code = $mix_code;

        return $this;
    }

    public function getAmountToSend(): ?float
    {
        return $this->amount_to_send;
    }

    public function setAmountToSend(float $amount_to_send): self
    {
        $this->amount_to_send = $amount_to_send;

        return $this;
    }

    public function isOverMax(): ?bool
    {
        return $this->over_max;
    }

    public function setOverMax(bool $over_max): self
    {
        $this->over_max = $over_max;

        return $this;
    }

    public function getLetterOfGuaranteeUri(): ?string
    {
        return $this->letter_of_guarantee_uri;
    }

    public function setLetterOfGuaranteeUri(string $letter_of_guarantee_uri): self
    {
        $this->letter_of_guarantee_uri = $letter_of_guarantee_uri;

        return $this;
    }

    /**
     * @return Collection<int, InputTransaction>
     */
    public function getInputTransaction(): Collection
    {
        return $this->inputTransaction;
    }

    public function addInputTransaction(InputTransaction $inputTransaction): self
    {
        if (!$this->inputTransaction->contains($inputTransaction)) {
            $this->inputTransaction->add($inputTransaction);
            $inputTransaction->setMixorder($this);
        }

        return $this;
    }

    public function removeInputTransaction(InputTransaction $inputTransaction): self
    {
        if ($this->inputTransaction->removeElement($inputTransaction)) {
            // set the owning side to null (unless already changed)
            if ($inputTransaction->getMixorder() === $this) {
                $inputTransaction->setMixorder(null);
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
            $outputTransaction->setMixorder($this);
        }

        return $this;
    }

    public function removeOutputTransaction(OutputTransaction $outputTransaction): self
    {
        if ($this->outputTransaction->removeElement($outputTransaction)) {
            // set the owning side to null (unless already changed)
            if ($outputTransaction->getMixorder() === $this) {
                $outputTransaction->setMixorder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AddressMixing>
     */
    public function getAddressMixingId(): Collection
    {
        return $this->AddressMixingId;
    }

    public function addAddressMixingId(AddressMixing $addressMixingId): self
    {
        if (!$this->AddressMixingId->contains($addressMixingId)) {
            $this->AddressMixingId->add($addressMixingId);
            $addressMixingId->setMixorder($this);
        }

        return $this;
    }

    public function removeAddressMixingId(AddressMixing $addressMixingId): self
    {
        if ($this->AddressMixingId->removeElement($addressMixingId)) {
            // set the owning side to null (unless already changed)
            if ($addressMixingId->getMixorder() === $this) {
                $addressMixingId->setMixorder(null);
            }
        }

        return $this;
    }

    public function getMixingCodeRelation(): ?MixingCode
    {
        return $this->MixingCodeRelation;
    }

    public function setMixingCodeRelation(MixingCode $MixingCodeRelation): self
    {
        // set the owning side of the relation if necessary
        if ($MixingCodeRelation->getMixorder() !== $this) {
            $MixingCodeRelation->setMixorder($this);
        }

        $this->MixingCodeRelation = $MixingCodeRelation;

        return $this;
    }
}
