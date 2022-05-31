<?php

namespace App\Entity;

use App\Repository\PostContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostContentRepository::class)
 */
class PostContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Post::class, inversedBy="content", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionPage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $alimentalPage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $medicinalPage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $agricolPage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $IndustrialPage;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $images = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $links = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getDescriptionPage(): ?string
    {
        return $this->descriptionPage;
    }

    public function setDescriptionPage(string $descriptionPage): self
    {
        $this->descriptionPage = $descriptionPage;

        return $this;
    }

    public function getAlimentalPage(): ?string
    {
        return $this->alimentalPage;
    }

    public function setAlimentalPage(?string $alimentalPage): self
    {
        $this->alimentalPage = $alimentalPage;

        return $this;
    }

    public function getMedicinalPage(): ?string
    {
        return $this->medicinalPage;
    }

    public function setMedicinalPage(?string $medicinalPage): self
    {
        $this->medicinalPage = $medicinalPage;

        return $this;
    }

    public function getAgricolPage(): ?string
    {
        return $this->agricolPage;
    }

    public function setAgricolPage(?string $agricolPage): self
    {
        $this->agricolPage = $agricolPage;

        return $this;
    }

    public function getIndustrialPage(): ?string
    {
        return $this->IndustrialPage;
    }

    public function setIndustrialPage(?string $IndustrialPage): self
    {
        $this->IndustrialPage = $IndustrialPage;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getLinks(): ?array
    {
        return $this->links;
    }

    public function setLinks(?array $links): self
    {
        $this->links = $links;

        return $this;
    }
}
