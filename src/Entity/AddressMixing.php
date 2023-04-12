<?php

namespace App\Entity;

use App\Repository\AddressMixingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressMixingRepository::class)]
class AddressMixing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $percentage = null;

    #[ORM\Column]
    private ?\DateTime $delay = null;

    #[ORM\ManyToOne(inversedBy: 'AddressMixingId')]
    #[ORM\JoinColumn(nullable: true)]
    private ?MixOrder $mixorder = null;

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

    public function getPercentage(): ?int
    {
        return $this->percentage;
    }

    public function setPercentage(int $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function getDelay(): ?\DateTime
    {
        return $this->delay;
    }

    public function setDelay(\DateTime $delay): self
    {
        $this->delay = $delay;

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
