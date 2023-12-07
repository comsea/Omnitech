<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $caracteristique = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_published = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?ProductSupplier $supplier = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?ProductSubCategory $sub_category = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?ProductCategory $category = null;

    #[ORM\ManyToOne(inversedBy: 'product')]
    private ?ProductDivision $productDivision = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?ProductSubDivision $subDivision = null;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getCaracteristique(): ?string
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(string $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->is_published;
    }

    public function setIsPublished(?bool $is_published): self
    {
        $this->is_published = $is_published;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getSupplier(): ?ProductSupplier
    {
        return $this->supplier;
    }

    public function setSupplier(?ProductSupplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getSubCategory(): ?ProductSubCategory
    {
        return $this->sub_category;
    }

    public function setSubCategory(?ProductSubCategory $sub_category): self
    {
        $this->sub_category = $sub_category;

        return $this;
    }

    public function getCategory(): ?ProductCategory
    {
        return $this->category;
    }

    public function setCategory(?ProductCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getProductDivision(): ?ProductDivision
    {
        return $this->productDivision;
    }

    public function setProductDivision(?ProductDivision $productDivision): self
    {
        $this->productDivision = $productDivision;

        return $this;
    }

    public function getSubDivision(): ?ProductSubDivision
    {
        return $this->subDivision;
    }

    public function setSubDivision(?ProductSubDivision $subDivision): self
    {
        $this->subDivision = $subDivision;

        return $this;
    }
}
