<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 510)]
    private ?string $path = null;

    #[ORM\ManyToMany(targetEntity: News::class, mappedBy: 'gallery')]
    private Collection $gallery;

    public function __construct()
    {
        $this->gallery = new ArrayCollection();
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

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return Collection<int, News>
     */
    public function getGallery(): Collection
    {
        return $this->gallery;
    }

    public function addGallery(News $gallery): self
    {
        if (!$this->gallery->contains($gallery)) {
            $this->gallery->add($gallery);
            $gallery->addGallery($this);
        }

        return $this;
    }

    public function removeGallery(News $gallery): self
    {
        if ($this->gallery->removeElement($gallery)) {
            $gallery->removeGallery($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
