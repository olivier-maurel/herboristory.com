<?php

namespace App\Entity;

use App\Repository\PlantFeatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlantFeatureRepository::class)
 */
class PlantFeature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Plant::class, inversedBy="feature", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $plant;

    /**
     * @ORM\Column(name="feature_leaf", type="text", nullable=true)
     */
    private $leaf;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $rod;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $root;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $flower;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $fruct;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $seed;

    /**
     * @ORM\ManyToMany(targetEntity=PlantAttribute::class)
     */
    private $attributes;

    // /**
    //  * @ORM\ManyToMany(targetEntity=PlantAttribute::class)
    //  */
    // private $season;

    // /**
    //  * @ORM\ManyToMany(targetEntity=PlantAttribute::class)
    //  */
    // private $habitat;

    public function __construct()
    {
        $this->color = new ArrayCollection();
        $this->season = new ArrayCollection();
        $this->habitat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlant(): ?Plant
    {
        return $this->plant;
    }

    public function setPlant(Plant $plant): self
    {
        $this->plant = $plant;

        return $this;
    }

    public function getLeaf(): ?string
    {
        return $this->leaf;
    }

    public function setLeaf(?string $leaf): self
    {
        $this->leaf = $leaf;

        return $this;
    }

    public function getRod(): ?string
    {
        return $this->rod;
    }

    public function setRod(?string $rod): self
    {
        $this->rod = $rod;

        return $this;
    }

    public function getRoot(): ?string
    {
        return $this->root;
    }

    public function setRoot(?string $root): self
    {
        $this->root = $root;

        return $this;
    }

    public function getFlower(): ?string
    {
        return $this->flower;
    }

    public function setFlower(?string $flower): self
    {
        $this->flower = $flower;

        return $this;
    }

    public function getFruct(): ?string
    {
        return $this->fruct;
    }

    public function setFruct(?string $fruct): self
    {
        $this->fruct = $fruct;

        return $this;
    }

    public function getSeed(): ?string
    {
        return $this->seed;
    }

    public function setSeed(?string $seed): self
    {
        $this->seed = $seed;

        return $this;
    }

    /**
     * @return Collection<int, PlantAttribute>
     */
    public function getColor(): Collection
    {
        return $this->color;
    }

    public function addColor(PlantAttribute $color): self
    {
        if (!$this->color->contains($color)) {
            $this->color[] = $color;
        }

        return $this;
    }

    public function removeColor(PlantAttribute $color): self
    {
        $this->color->removeElement($color);

        return $this;
    }

    /**
     * @return Collection<int, PlantAttribute>
     */
    public function getSeason(): Collection
    {
        return $this->season;
    }

    public function addSeason(PlantAttribute $season): self
    {
        if (!$this->season->contains($season)) {
            $this->season[] = $season;
        }

        return $this;
    }

    public function removeSeason(PlantAttribute $season): self
    {
        $this->season->removeElement($season);

        return $this;
    }

    /**
     * @return Collection<int, PlantAttribute>
     */
    public function getHabitat(): Collection
    {
        return $this->habitat;
    }

    public function addHabitat(PlantAttribute $habitat): self
    {
        if (!$this->habitat->contains($habitat)) {
            $this->habitat[] = $habitat;
        }

        return $this;
    }

    public function removeHabitat(PlantAttribute $habitat): self
    {
        $this->habitat->removeElement($habitat);

        return $this;
    }
    
}
