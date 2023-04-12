<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatisticsRepository::class)]
class Statistics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(nullable: true)]
    private ?int $exchange_order_amount_eth = null;

    #[ORM\Column(nullable: true)]
    private ?int $exchange_order_amount_btc = null;

    #[ORM\Column(nullable: true)]
    private ?int $exchange_order_amount_usdc = null;

    #[ORM\Column(nullable: true)]
    private ?int $exchange_order_amount_usdt = null;

    #[ORM\Column(nullable: true)]
    private ?int $mixing_order_amount_eth = null;

    #[ORM\Column(nullable: true)]
    private ?int $mixing_order_amount_btc = null;

    #[ORM\Column(nullable: true)]
    private ?int $mixing_order_amount_usdc = null;

    #[ORM\Column(nullable: true)]
    private ?int $mixing_order_amount_usdt = null;

    #[ORM\Column(nullable: true)]
    private ?float $exchange_order_eth = null;

    #[ORM\Column(nullable: true)]
    private ?float $exchange_order_btc = null;

    #[ORM\Column(nullable: true)]
    private ?float $exchange_order_usdc = null;

    #[ORM\Column(nullable: true)]
    private ?float $exchange_order_usdt = null;

    #[ORM\Column(nullable: true)]
    private ?float $mixing_order_eth = null;

    #[ORM\Column(nullable: true)]
    private ?float $mixing_order_btc = null;

    #[ORM\Column(nullable: true)]
    private ?float $mixing_order_usdt = null;

    #[ORM\Column(nullable: true)]
    private ?float $mixing_order_usdc = null;



    #[ORM\Column(nullable: true)]
    private ?float $revenue_eth = null;

    #[ORM\Column(nullable: true)]
    private ?float $revenue_btc = null;

    #[ORM\Column(nullable: true)]
    private ?float $revenue_usdt = null;

    #[ORM\Column(nullable: true)]
    private ?float $revenue_usdc = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getExchangeOrderAmountEth(): ?int
    {
        return $this->exchange_order_amount_eth;
    }

    public function setExchangeOrderAmountEth(int $exchange_order_amount_eth): self
    {
        $this->exchange_order_amount_eth = $exchange_order_amount_eth;

        return $this;
    }

    public function getExchangeOrderAmountBtc(): ?int
    {
        return $this->exchange_order_amount_btc;
    }

    public function setExchangeOrderAmountBtc(?int $exchange_order_amount_btc): self
    {
        $this->exchange_order_amount_btc = $exchange_order_amount_btc;

        return $this;
    }

    public function getExchangeOrderAmountUsdc(): ?int
    {
        return $this->exchange_order_amount_usdc;
    }

    public function setExchangeOrderAmountUsdc(?int $exchange_order_amount_usdc): self
    {
        $this->exchange_order_amount_usdc = $exchange_order_amount_usdc;

        return $this;
    }

    public function getExchangeOrderAmountUsdt(): ?int
    {
        return $this->exchange_order_amount_usdt;
    }

    public function setExchangeOrderAmountUsdt(?int $exchange_order_amount_usdt): self
    {
        $this->exchange_order_amount_usdt = $exchange_order_amount_usdt;

        return $this;
    }

    public function getMixingOrderAmountEth(): ?int
    {
        return $this->mixing_order_amount_eth;
    }

    public function setMixingOrderAmountEth(?int $mixing_order_amount_eth): self
    {
        $this->mixing_order_amount_eth = $mixing_order_amount_eth;

        return $this;
    }

    public function getMixingOrderAmountBtc(): ?int
    {
        return $this->mixing_order_amount_btc;
    }

    public function setMixingOrderAmountBtc(?int $mixing_order_amount_btc): self
    {
        $this->mixing_order_amount_btc = $mixing_order_amount_btc;

        return $this;
    }

    public function getMixingOrderAmountUsdc(): ?int
    {
        return $this->mixing_order_amount_usdc;
    }

    public function setMixingOrderAmountUsdc(?int $mixing_order_amount_usdc): self
    {
        $this->mixing_order_amount_usdc = $mixing_order_amount_usdc;

        return $this;
    }

    public function getMixingOrderAmountUsdt(): ?int
    {
        return $this->mixing_order_amount_usdt;
    }

    public function setMixingOrderAmountUsdt(?int $mixing_order_amount_usdt): self
    {
        $this->mixing_order_amount_usdt = $mixing_order_amount_usdt;

        return $this;
    }

    public function getExchangeOrderEth(): ?float
    {
        return $this->exchange_order_eth;
    }

    public function setExchangeOrderEth(?float $exchange_order_eth): self
    {
        $this->exchange_order_eth = $exchange_order_eth;

        return $this;
    }

    public function getExchangeOrderBtc(): ?float
    {
        return $this->exchange_order_btc;
    }

    public function setExchangeOrderBtc(?float $exchange_order_btc): self
    {
        $this->exchange_order_btc = $exchange_order_btc;

        return $this;
    }

    public function getExchangeOrderUsdc(): ?float
    {
        return $this->exchange_order_usdc;
    }

    public function setExchangeOrderUsdc(?float $exchange_order_usdc): self
    {
        $this->exchange_order_usdc = $exchange_order_usdc;

        return $this;
    }

    public function getExchangeOrderUsdt(): ?float
    {
        return $this->exchange_order_usdt;
    }

    public function setExchangeOrderUsdt(?float $exchange_order_usdt): self
    {
        $this->exchange_order_usdt = $exchange_order_usdt;

        return $this;
    }

    public function getMixingOrderEth(): ?float
    {
        return $this->mixing_order_eth;
    }

    public function setMixingOrderEth(?float $mixing_order_eth): self
    {
        $this->mixing_order_eth = $mixing_order_eth;

        return $this;
    }

    public function getMixingOrderBtc(): ?float
    {
        return $this->mixing_order_btc;
    }

    public function setMixingOrderBtc(?float $mixing_order_btc): self
    {
        $this->mixing_order_btc = $mixing_order_btc;

        return $this;
    }

    public function getMixingOrderUsdt(): ?float
    {
        return $this->mixing_order_usdt;
    }

    public function setMixingOrderUsdt(?float $mixing_order_usdt): self
    {
        $this->mixing_order_usdt = $mixing_order_usdt;

        return $this;
    }

    public function getMixingOrderUsdc(): ?float
    {
        return $this->mixing_order_usdc;
    }

    public function setMixingOrderUsdc(?float $mixing_order_usdc): self
    {
        $this->mixing_order_usdc = $mixing_order_usdc;

        return $this;
    }


    public function getRevenueEth(): ?float
    {
        return $this->revenue_eth;
    }

    public function setRevenueEth(?float $revenue_eth): self
    {
        $this->revenue_eth = $revenue_eth;

        return $this;
    }

    public function getRevenueBtc(): ?float
    {
        return $this->revenue_btc;
    }

    public function setRevenueBtc(?float $revenue_btc): self
    {
        $this->revenue_btc = $revenue_btc;

        return $this;
    }

    public function getRevenueUsdt(): ?float
    {
        return $this->revenue_usdt;
    }

    public function setRevenueUsdt(?float $revenue_usdt): self
    {
        $this->revenue_usdt = $revenue_usdt;

        return $this;
    }

    public function getRevenueUsdc(): ?float
    {
        return $this->revenue_usdc;
    }

    public function setRevenueUsdc(?float $revenue_usdc): self
    {
        $this->revenue_usdc = $revenue_usdc;

        return $this;
    }
}
