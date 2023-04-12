<?php

namespace App\Entity;

use App\Repository\InputTransactionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InputTransactionRepository::class)]
class InputTransaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $hash = null;

    #[ORM\Column(length: 255)]
    private ?string $currency = null;

    #[ORM\Column(length: 255)]
    private ?string $receiver = null;

    #[ORM\Column(length: 255)]
    private ?string $sender = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column]
    private ?bool $risk_is_low = null;

    #[ORM\ManyToOne(inversedBy: 'inputTransaction')]
    private ?ExOrder $exorder = null;

    #[ORM\ManyToOne(inversedBy: 'inputTransaction')]
    private ?MixOrder $mixorder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getReceiver(): ?string
    {
        return $this->receiver;
    }

    public function setReceiver(string $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function isRiskIsLow(): ?bool
    {
        return $this->risk_is_low;
    }

    public function setRiskIsLow(bool $risk_is_low): self
    {
        $this->risk_is_low = $risk_is_low;

        return $this;
    }

    public function getExorder(): ?ExOrder
    {
        return $this->exorder;
    }

    public function setExorder(?ExOrder $exorder): self
    {
        $this->exorder = $exorder;

        return $this;
    }

    public function getMixorder(): ?MixOrder
    {
        return $this->mixorder;
    }

    public function setMixorder(?MixOrder $mixorder): self
    {
        $this->mixorder = $mixorder;

        return $this;
    }
}
