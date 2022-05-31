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
     * @ORM\Column(type="json")
     */
    private $category = [];

    /**
     * @ORM\OneToOne(targetEntity=PlantFeature::class, mappedBy="plant", cascade={"persist", "remove"})
     */
    private $feature;

    /**
     * @ORM\Column(type="json")
     */
    private $uses = [];

    /**
     * @ORM\ManyToMany(targetEntity=Plant::class, inversedBy="similitudes")
     */
    private $similitude;

    /**
     * @ORM\ManyToMany(targetEntity=Plant::class, mappedBy="similitude")
     */
    private $similitudes;

    /**
     * @ORM\OneToOne(targetEntity=Post::class, mappedBy="plant", cascade={"persist", "remove"})
     */
    private $post;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->similitude = new ArrayCollection();
        $this->similitudes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->commonName;
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

    public function getCategory(): ?array
    {
        return $this->category;
    }

    public function setCategory(array $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFeature(): ?PlantFeature
    {
        return $this->feature;
    }

    public function setFeature(PlantFeature $feature): self
    {
        // set the owning side of the relation if necessary
        if ($feature->getPlant() !== $this) {
            $feature->setPlant($this);
        }

        $this->feature = $feature;

        return $this;
    }

    public function getUses(): ?array
    {
        return $this->uses;
    }

    public function setUses(array $uses): self
    {
        $this->uses = $uses;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSimilitude(): Collection
    {
        return $this->similitude;
    }

    public function addSimilitude(self $similitude): self
    {
        if (!$this->similitude->contains($similitude)) {
            $this->similitude[] = $similitude;
        }

        return $this;
    }

    public function removeSimilitude(self $similitude): self
    {
        $this->similitude->removeElement($similitude);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSimilitudes(): Collection
    {
        $array   = array_unique(array_merge($this->similitude->toArray(), $this->similitudes->toArray()));
        $inArray = array_search($this, $array);
        
        if ($inArray !== false)
            unset($array[$inArray]);

        return new ArrayCollection($array);
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        // unset the owning side of the relation if necessary
        if ($post === null && $this->post !== null) {
            $this->post->setPlant(null);
        }

        // set the owning side of the relation if necessary
        if ($post !== null && $post->getPlant() !== $this) {
            $post->setPlant($this);
        }

        $this->post = $post;

        return $this;
    }
}
