<?php

namespace App\Entity;

use App\Repository\ContractTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractTypeRepository::class)]
class ContractType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\ManyToMany(targetEntity: Job::class, mappedBy: 'contractType')]
    private Collection $contractType;

    public function __construct()
    {
        $this->contractType = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return Collection<int, Job>
     */
    public function getContractType(): Collection
    {
        return $this->contractType;
    }

    public function addContractType(Job $contractType): self
    {
        if (!$this->contractType->contains($contractType)) {
            $this->contractType->add($contractType);
            $contractType->addContractType($this);
        }

        return $this;
    }

    public function removeContractType(Job $contractType): self
    {
        if ($this->contractType->removeElement($contractType)) {
            $contractType->removeContractType($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}