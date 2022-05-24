<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
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
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $keywords = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Plant::class, inversedBy="posts")
     */
    private $plant;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $page_alimental;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $page_medicinal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $page_agricol;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $page_industrial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __toString()
    {
        return $this->title;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getKeywords(): ?array
    {
        return $this->keywords;
    }

    public function setKeywords(?array $keywords): self
    {
        $this->keywords = $keywords;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPlant(): ?Plant
    {
        return $this->plant;
    }

    public function setPlant(?Plant $plant): self
    {
        $this->plant = $plant;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modified_at;
    }

    public function setModifiedAt(?\DateTimeInterface $modified_at): self
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPageAlimental(): ?string
    {
        return $this->page_alimental;
    }

    public function setPageAlimental(?string $page_alimental): self
    {
        $this->page_alimental = $page_alimental;

        return $this;
    }

    public function getPageMedicinal(): ?string
    {
        return $this->page_medicinal;
    }

    public function setPageMedicinal(?string $page_medicinal): self
    {
        $this->page_medicinal = $page_medicinal;

        return $this;
    }

    public function getPageAgricol(): ?string
    {
        return $this->page_agricol;
    }

    public function setPageAgricol(?string $page_agricol): self
    {
        $this->page_agricol = $page_agricol;

        return $this;
    }

    public function getPageIndustrial(): ?string
    {
        return $this->page_industrial;
    }

    public function setPageIndustrial(?string $page_industrial): self
    {
        $this->page_industrial = $page_industrial;

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
}
