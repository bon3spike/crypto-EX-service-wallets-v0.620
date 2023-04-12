<?php

namespace App\Entity;

use App\Repository\MixingCodeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MixingCodeRepository::class)]
class MixingCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $mixing_code = null;

    #[ORM\Column(length: 255)]
    private ?string $address_ids = null;

    #[ORM\OneToOne(inversedBy: 'MixingCodeRelation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?MixOrder $mixorder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMixingCode(): ?string
    {
        return $this->mixing_code;
    }

    public function setMixingCode(string $mixing_code): self
    {
        $this->mixing_code = $mixing_code;

        return $this;
    }

    public function getAddressIds(): ?string
    {
        return $this->address_ids;
    }

    public function setAddressIds(string $address_ids): self
    {
        $this->address_ids = $address_ids;

        return $this;
    }

    public function getMixorder(): ?MixOrder
    {
        return $this->mixorder;
    }

    public function setMixorder(MixOrder $mixorder): self
    {
        $this->mixorder = $mixorder;

        return $this;
    }
}
