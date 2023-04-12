<?php

namespace App\Entity;

use App\Repository\ExOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExOrderRepository::class)]
class ExOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $address_of_service = null;

    #[ORM\Column]
    private ?int $wallet_of_service = null;


    #[ORM\Column]
    private ?\DateTime $created_at = null;

    #[ORM\Column]
    private ?string $status_id = null;

    #[ORM\Column(length: 20)]
    private ?string $currency_to_recieve = null;

    #[ORM\Column(length: 20)]
    private ?string $currency_to_send = null;

    #[ORM\Column]
    private ?float $amount_to_recieve = null;

    #[ORM\Column]
    private ?float $amount_to_send = null;

    #[ORM\Column]
    private ?bool $low_risk = null;

    #[ORM\Column]
    private ?bool $low_risk_confirmed = null;



    #[ORM\Column]
    private ?bool $recieve_btc_b = null;

    #[ORM\Column(nullable: true)]
    private ?float $commission_persents = null;

    #[ORM\Column(nullable: true)]
    private ?float $commission_of_risk_for_sending = null;

    #[ORM\Column(nullable: true)]
    private ?float $commission_of_risk_of_recieving = null;

    #[ORM\Column]
    private ?float $comission_of_service = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $letter_of_guarantee_uri = null;

    #[ORM\Column(length: 100)]
    private ?string $address_of_user = null;

    #[ORM\OneToMany(mappedBy: 'exorder', targetEntity: InputTransaction::class)]
    private Collection $inputTransaction;

    #[ORM\OneToMany(mappedBy: 'exorder', targetEntity: OutputTransaction::class)]
    private Collection $outputTransaction;

    public function __construct()
    {
        $this->inputTransaction = new ArrayCollection();
        $this->outputTransaction = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getStatusId(): ?string
    {
        return $this->status_id;
    }

    public function setStatusId(string $status_id): self
    {
        $this->status_id = $status_id;

        return $this;
    }

    public function getCurrencyToRecieve(): ?string
    {
        return $this->currency_to_recieve;
    }

    public function setCurrencyToRecieve(string $currency_to_recieve): self
    {
        $this->currency_to_recieve = $currency_to_recieve;

        return $this;
    }

    public function getCurrencyToSend(): ?string
    {
        return $this->currency_to_send;
    }

    public function setCurrencyToSend(string $currency_to_send): self
    {
        $this->currency_to_send = $currency_to_send;

        return $this;
    }

    public function getAmountToRecieve(): ?float
    {
        return $this->amount_to_recieve;
    }

    public function setAmountToRecieve(float $amount_to_recieve): self
    {
        $this->amount_to_recieve = $amount_to_recieve;

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

    public function isLowRisk(): ?bool
    {
        return $this->low_risk;
    }

    public function setLowRisk(bool $low_risk): self
    {
        $this->low_risk = $low_risk;

        return $this;
    }

    public function isLowRiskConfirmed(): ?bool
    {
        return $this->low_risk_confirmed;
    }

    public function setLowRiskConfirmed(bool $low_risk_confirmed): self
    {
        $this->low_risk_confirmed = $low_risk_confirmed;

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

    public function setCommissionPersents(?float $commission_persents): self
    {
        $this->commission_persents = $commission_persents;

        return $this;
    }

    public function getCommissionOfRiskForSending(): ?float
    {
        return $this->commission_of_risk_for_sending;
    }

    public function setCommissionOfRiskForSending(?float $commission_of_risk_for_sending): self
    {
        $this->commission_of_risk_for_sending = $commission_of_risk_for_sending;

        return $this;
    }

    public function getCommissionOfRiskOfRecieving(): ?float
    {
        return $this->commission_of_risk_of_recieving;
    }

    public function setCommissionOfRiskOfRecieving(?float $commission_of_risk_of_recieving): self
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

    public function getLetterOfGuaranteeUri(): ?string
    {
        return $this->letter_of_guarantee_uri;
    }

    public function setLetterOfGuaranteeUri(string $letter_of_guarantee_uri): self
    {
        $this->letter_of_guarantee_uri = $letter_of_guarantee_uri;

        return $this;
    }

    public function getAddressOfUser(): ?string
    {
        return $this->address_of_user;
    }

    public function setAddressOfUser(string $address_of_user): self
    {
        $this->address_of_user = $address_of_user;

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
            $inputTransaction->setExorder($this);
        }

        return $this;
    }

    public function removeInputTransaction(InputTransaction $inputTransaction): self
    {
        if ($this->inputTransaction->removeElement($inputTransaction)) {
            // set the owning side to null (unless already changed)
            if ($inputTransaction->getExorder() === $this) {
                $inputTransaction->setExorder(null);
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
            $outputTransaction->setExorder($this);
        }

        return $this;
    }

    public function removeOutputTransaction(OutputTransaction $outputTransaction): self
    {
        if ($this->outputTransaction->removeElement($outputTransaction)) {
            // set the owning side to null (unless already changed)
            if ($outputTransaction->getExorder() === $this) {
                $outputTransaction->setExorder(null);
            }
        }

        return $this;
    }
}
