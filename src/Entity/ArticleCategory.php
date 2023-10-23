<?php

namespace App\Entity;

use App\Repository\ArticleCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleCategoryRepository::class)]
class ArticleCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\OneToMany(mappedBy: 'articleCategory', targetEntity: WorkShop::class)]
    private Collection $articleCategory;

    public function __construct()
    {
        $this->articleCategory = new ArrayCollection();
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
     * @return Collection<int, Workshop>
     */
    public function getArticleCategory(): Collection
    {
        return $this->articleCategory;
    }

    public function addArticleCategory(WorkShop $articleCategory): self
    {
        if (!$this->articleCategory->contains($articleCategory)) {
            $this->articleCategory->add($articleCategory);
            $articleCategory->setArticleCategory($this);
        }

        return $this;
    }

    public function removeArticleCategory(WorkShop $articleCategory): self
    {
        if ($this->articleCategory->removeElement($articleCategory)) {
            // set the owning side to null (unless already changed)
            if ($articleCategory->getArticleCategory() === $this) {
                $articleCategory->setArticleCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
