<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlantRepository::class)
 */
class Plant
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
    private $commonName;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $scientific_class;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $scientific_order;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $scientific_family;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $scientific_genus;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $scientific_species;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $iucn_redlist;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="plant")
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommonName(): ?string
    {
        return $this->commonName;
    }

    public function setCommonName(string $commonName): self
    {
        $this->commonName = $commonName;

        return $this;
    }

    public function getScientificClass(): ?string
    {
        return $this->scientific_class;
    }

    public function setScientificClass(string $scientific_class): self
    {
        $this->scientific_class = $scientific_class;

        return $this;
    }

    public function getScientificOrder(): ?string
    {
        return $this->scientific_order;
    }

    public function setScientificOrder(string $scientific_order): self
    {
        $this->scientific_order = $scientific_order;

        return $this;
    }

    public function getScientificFamily(): ?string
    {
        return $this->scientific_family;
    }

    public function setScientificFamily(string $scientific_family): self
    {
        $this->scientific_family = $scientific_family;

        return $this;
    }

    public function getScientificGenus(): ?string
    {
        return $this->scientific_genus;
    }

    public function setScientificGenus(string $scientific_genus): self
    {
        $this->scientific_genus = $scientific_genus;

        return $this;
    }

    public function getScientificSpecies(): ?string
    {
        return $this->scientific_species;
    }

    public function setScientificSpecies(string $scientific_species): self
    {
        $this->scientific_species = $scientific_species;

        return $this;
    }

    public function getIucnRedlist(): ?string
    {
        return $this->iucn_redlist;
    }

    public function setIucnRedlist(string $iucn_redlist): self
    {
        $this->iucn_redlist = $iucn_redlist;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setPlant($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getPlant() === $this) {
                $post->setPlant(null);
            }
        }

        return $this;
    }
}
