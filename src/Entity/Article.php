<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Model\TimestampedInterface;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\Table(name="article", indexes={@ORM\Index(columns={"title", "introduction", "conclusion"}, flags={"fulltext"})})
 */
class Article implements TimestampedInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $introduction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $featuredImage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $conclusion;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="articles")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Section::class, mappedBy="article", orphanRemoval=true, cascade={"persist"})
     */
    private $sections;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Image::class, inversedBy="articles")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Link::class, inversedBy="articles")
     */
    private $links;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->sections = new ArrayCollection();
        $this->links = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(?string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getFeaturedImage(): ?string
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(?string $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function getConclusion(): ?string
    {
        return $this->conclusion;
    }

    public function setConclusion(?string $conclusion): self
    {
        $this->conclusion = $conclusion;

        return $this;
    }

    /**
     * @return Collection<int, category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, section>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
            $section->setArticle($this);
        }

        return $this;
    }

    public function removeSection(section $section): self
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getArticle() === $this) {
                $section->setArticle(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Link>
     */
    public function getLinks(): Collection
    {
        return $this->links;
    }

    public function addLink(Link $link): self
    {
        if (!$this->links->contains($link)) {
            $this->links[] = $link;
        }

        return $this;
    }

    public function removeLink(Link $link): self
    {
        $this->links->removeElement($link);

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
