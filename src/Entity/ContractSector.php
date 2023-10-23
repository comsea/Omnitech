<?php

namespace App\Entity;

use App\Repository\ContractSectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractSectorRepository::class)]
class ContractSector
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\OneToMany(mappedBy: 'contractSector', targetEntity: Job::class)]
    private Collection $contractSector;

    public function __construct()
    {
        $this->contractSector = new ArrayCollection();
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
    public function getContractSector(): Collection
    {
        return $this->contractSector;
    }

    public function addContractSector(Job $contractSector): self
    {
        if (!$this->contractSector->contains($contractSector)) {
            $this->contractSector->add($contractSector);
            $contractSector->setContractSector($this);
        }

        return $this;
    }

    public function removeContractSector(Job $contractSector): self
    {
        if ($this->contractSector->removeElement($contractSector)) {
            // set the owning side to null (unless already changed)
            if ($contractSector->getContractSector() === $this) {
                $contractSector->setContractSector(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
