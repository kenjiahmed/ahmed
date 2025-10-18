<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Brand;
use App\Entity\Category;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $modele = null;

    #[ManyToOne(targetEntity: Brand::class)]
    #[JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?Brand $marque = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?string $prixJournalier = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ManyToOne(targetEntity: Category::class)]
    #[JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?Category $categorie = null;

    #[ORM\Column(length: 20)]
    private ?string $transmission = null; // Automatique / Manuelle

    #[ORM\Column(length: 20)]
    private ?string $carburant = null; // Essence / Diesel / Hybride / Électrique

    #[ORM\Column(type: 'smallint')]
    private ?int $places = null;

    #[ORM\Column(type: 'smallint')]
    private ?int $portes = null;

    #[ORM\Column(type: 'boolean')]
    private bool $disponible = true;

    #[OneToMany(mappedBy: 'vehicule', targetEntity: Image::class, orphanRemoval: true)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /** @return Collection<int, Image> */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setVehicule($this);
        }
        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            if ($image->getVehicule() === $this) {
                $image->setVehicule(null);
            }
        }
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;
        return $this;
    }

    public function getMarque(): ?Brand
    {
        return $this->marque;
    }

    public function setMarque(?Brand $marque): self
    {
        $this->marque = $marque;
        return $this;
    }

    public function getPrixJournalier(): ?string
    {
        return $this->prixJournalier;
    }

    public function setPrixJournalier(string $prixJournalier): self
    {
        $this->prixJournalier = $prixJournalier;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCategorie(): ?Category
    {
        return $this->categorie;
    }

    public function setCategorie(?Category $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;
        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;
        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): self
    {
        $this->places = $places;
        return $this;
    }

    public function getPortes(): ?int
    {
        return $this->portes;
    }

    public function setPortes(int $portes): self
    {
        $this->portes = $portes;
        return $this;
    }

    public function isDisponible(): bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;
        return $this;
    }
}
