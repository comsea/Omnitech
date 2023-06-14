<?php

namespace App\Entity;

use App\Repository\NewsCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsCategoryRepository::class)]
class NewsCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\OneToMany(mappedBy: 'newsCategory', targetEntity: News::class)]
    private Collection $newsCategory;

    public function __construct()
    {
        $this->newsCategory = new ArrayCollection();
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
     * @return Collection<int, News>
     */
    public function getNewsCategory(): Collection
    {
        return $this->newsCategory;
    }

    public function addNewsCategory(News $newsCategory): self
    {
        if (!$this->newsCategory->contains($newsCategory)) {
            $this->newsCategory->add($newsCategory);
            $newsCategory->setNewsCategory($this);
        }

        return $this;
    }

    public function removeNewsCategory(News $newsCategory): self
    {
        if ($this->newsCategory->removeElement($newsCategory)) {
            // set the owning side to null (unless already changed)
            if ($newsCategory->getNewsCategory() === $this) {
                $newsCategory->setNewsCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
