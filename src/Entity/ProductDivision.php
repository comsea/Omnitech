<?php

namespace App\Entity;

use App\Repository\ProductDivisionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductDivisionRepository::class)]
class ProductDivision
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\ManyToOne(inversedBy: 'productDivisions')]
    private ?ProductSubCategory $subCategory = null;

    #[ORM\OneToMany(mappedBy: 'productDivision', targetEntity: Product::class)]
    private Collection $product;

    #[ORM\OneToMany(mappedBy: 'subDivision', targetEntity: ProductSubDivision::class)]
    private Collection $productSubDivisions;

    public function __construct()
    {
        $this->product = new ArrayCollection();
        $this->productSubDivisions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getSubCategory(): ?ProductSubCategory
    {
        return $this->subCategory;
    }

    public function setSubCategory(?ProductSubCategory $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
            $product->setProductDivision($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->product->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getProductDivision() === $this) {
                $product->setProductDivision(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return Collection<int, ProductSubDivision>
     */
    public function getProductSubDivisions(): Collection
    {
        return $this->productSubDivisions;
    }

    public function addProductSubDivision(ProductSubDivision $productSubDivision): self
    {
        if (!$this->productSubDivisions->contains($productSubDivision)) {
            $this->productSubDivisions->add($productSubDivision);
            $productSubDivision->setSubDivision($this);
        }

        return $this;
    }

    public function removeProductSubDivision(ProductSubDivision $productSubDivision): self
    {
        if ($this->productSubDivisions->removeElement($productSubDivision)) {
            // set the owning side to null (unless already changed)
            if ($productSubDivision->getSubDivision() === $this) {
                $productSubDivision->setSubDivision(null);
            }
        }

        return $this;
    }
}
