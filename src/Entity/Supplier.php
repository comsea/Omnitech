<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupplierRepository::class)]
class Supplier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 510, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\ManyToMany(targetEntity: WorkShop::class, mappedBy: 'supplier')]
    private Collection $supplier;

    public function __construct()
    {
        $this->supplier = new ArrayCollection();
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

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
     * @return Collection<int, WorkShop>
     */
    public function getSupplier(): Collection
    {
        return $this->supplier;
    }

    public function addSupplier(WorkShop $supplier): self
    {
        if (!$this->supplier->contains($supplier)) {
            $this->supplier->add($supplier);
            $supplier->addSupplier($this);
        }

        return $this;
    }

    public function removeSupplier(WorkShop $supplier): self
    {
        if ($this->supplier->removeElement($supplier)) {
            $supplier->removeSupplier($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}