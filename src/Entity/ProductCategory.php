<?php

namespace App\Entity;

use App\Repository\ProductCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductCategoryRepository::class)]
class ProductCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    private Collection $products;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: ProductSubCategory::class)]
    private Collection $productSubCategory;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->productSubCategory = new ArrayCollection();
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
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductSubCategory>
     */
    public function getProductSubCategories(): Collection
    {
        return $this->productSubCategory;
    }

    public function addProductSubCategory(ProductSubCategory $productSubCategory): self
    {
        if (!$this->productSubCategory->contains($productSubCategory)) {
            $this->productSubCategory->add($productSubCategory);
            $productSubCategory->setCategory($this);
        }

        return $this;
    }

    public function removeProductSubCategory(ProductSubCategory $productSubCategory): self
    {
        if ($this->productSubCategory->removeElement($productSubCategory)) {
            // set the owning side to null (unless already changed)
            if ($productSubCategory->getCategory() === $this) {
                $productSubCategory->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
