<?php

namespace App\Entity;

use App\Repository\CommissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommissionRepository::class)]
class Commission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $exchange_min = null;

    #[ORM\Column]
    private ?float $exchange_max = null;

    #[ORM\Column]
    private ?float $exchange_for_sending_high_risk = null;

    #[ORM\Column]
    private ?float $exchange_for_btc_b = null;

    #[ORM\Column]
    private ?float $mix_btc_min = null;

    #[ORM\Column]
    private ?float $mix_btc_max = null;

    #[ORM\Column]
    private ?float $mix_eth_min = null;

    #[ORM\Column]
    private ?float $mix_eth_max = null;

    #[ORM\Column]
    private ?float $mix_usdt_min = null;

    #[ORM\Column]
    private ?float $mix_usdt_max = null;

    #[ORM\Column]
    private ?float $mix_usdc_min = null;

    #[ORM\Column]
    private ?float $mix_usdc_max = null;

    #[ORM\Column]
    private ?float $mix_for_sending_high_risk = null;

    #[ORM\Column]
    private ?float $mix_for_btc_b = null;

    #[ORM\Column]
    private ?float $btc_per_address = null;

    #[ORM\Column]
    private ?float $eth_per_address = null;

    #[ORM\Column]
    private ?float $usdt_per_address = null;

    #[ORM\Column]
    private ?float $usdc_per_address = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExchangeMin(): ?float
    {
        return $this->exchange_min;
    }

    public function setExchangeMin(float $exchange_min): self
    {
        $this->exchange_min = $exchange_min;

        return $this;
    }

    public function getExchangeMax(): ?float
    {
        return $this->exchange_max;
    }

    public function setExchangeMax(float $exchange_max): self
    {
        $this->exchange_max = $exchange_max;

        return $this;
    }

    public function getExchangeForSendingHighRisk(): ?float
    {
        return $this->exchange_for_sending_high_risk;
    }

    public function setExchangeForSendingHighRisk(float $exchange_for_sending_high_risk): self
    {
        $this->exchange_for_sending_high_risk = $exchange_for_sending_high_risk;

        return $this;
    }

    public function getExchangeForBtcB(): ?float
    {
        return $this->exchange_for_btc_b;
    }

    public function setExchangeForBtcB(float $exchange_for_btc_b): self
    {
        $this->exchange_for_btc_b = $exchange_for_btc_b;

        return $this;
    }

    public function getMixBtcMin(): ?float
    {
        return $this->mix_btc_min;
    }

    public function setMixBtcMin(float $mix_btc_min): self
    {
        $this->mix_btc_min = $mix_btc_min;

        return $this;
    }

    public function getMixBtcMax(): ?float
    {
        return $this->mix_btc_max;
    }

    public function setMixBtcMax(float $mix_btc_max): self
    {
        $this->mix_btc_max = $mix_btc_max;

        return $this;
    }

    public function getMixEthMin(): ?float
    {
        return $this->mix_eth_min;
    }

    public function setMixEthMin(float $mix_eth_min): self
    {
        $this->mix_eth_min = $mix_eth_min;

        return $this;
    }

    public function getMixEthMax(): ?float
    {
        return $this->mix_eth_max;
    }

    public function setMixEthMax(float $mix_eth_max): self
    {
        $this->mix_eth_max = $mix_eth_max;

        return $this;
    }

    public function getMixUsdtMin(): ?float
    {
        return $this->mix_usdt_min;
    }

    public function setMixUsdtMin(float $mix_usdt_min): self
    {
        $this->mix_usdt_min = $mix_usdt_min;

        return $this;
    }

    public function getMixUsdtMax(): ?float
    {
        return $this->mix_usdt_max;
    }

    public function setMixUsdtMax(float $mix_usdt_max): self
    {
        $this->mix_usdt_max = $mix_usdt_max;

        return $this;
    }

    public function getMixUsdcMin(): ?float
    {
        return $this->mix_usdc_min;
    }

    public function setMixUsdcMin(float $mix_usdc_min): self
    {
        $this->mix_usdc_min = $mix_usdc_min;

        return $this;
    }

    public function getMixUsdcMax(): ?float
    {
        return $this->mix_usdc_max;
    }

    public function setMixUsdcMax(float $mix_usdc_max): self
    {
        $this->mix_usdc_max = $mix_usdc_max;

        return $this;
    }

    public function getMixForSendingHighRisk(): ?float
    {
        return $this->mix_for_sending_high_risk;
    }

    public function setMixForSendingHighRisk(float $mix_for_sending_high_risk): self
    {
        $this->mix_for_sending_high_risk = $mix_for_sending_high_risk;

        return $this;
    }

    public function getMixForBtcB(): ?float
    {
        return $this->mix_for_btc_b;
    }

    public function setMixForBtcB(float $mix_for_btc_b): self
    {
        $this->mix_for_btc_b = $mix_for_btc_b;

        return $this;
    }

    public function getBtcPerAddress(): ?float
    {
        return $this->btc_per_address;
    }

    public function setBtcPerAddress(float $btc_per_address): self
    {
        $this->btc_per_address = $btc_per_address;

        return $this;
    }

    public function getEthPerAddress(): ?float
    {
        return $this->eth_per_address;
    }

    public function setEthPerAddress(float $eth_per_address): self
    {
        $this->eth_per_address = $eth_per_address;

        return $this;
    }

    public function getUsdtPerAddress(): ?float
    {
        return $this->usdt_per_address;
    }

    public function setUsdtPerAddress(float $usdt_per_address): self
    {
        $this->usdt_per_address = $usdt_per_address;

        return $this;
    }

    public function getUsdcPerAddress(): ?float
    {
        return $this->usdc_per_address;
    }

    public function setUsdcPerAddress(float $usdc_per_address): self
    {
        $this->usdc_per_address = $usdc_per_address;

        return $this;
    }
}
