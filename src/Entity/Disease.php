<?php

namespace App\Entity;

use App\Repository\DiseaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiseaseRepository::class)]
class Disease
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $symptoms = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $treatment = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $prevention = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Vegetable>
     */
    #[ORM\ManyToMany(targetEntity: Vegetable::class, inversedBy: 'diseases')]
    private Collection $vegetable;

    public function __construct()
    {
        $this->vegetable = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSymptoms(): ?string
    {
        return $this->symptoms;
    }

    public function setSymptoms(?string $symptoms): static
    {
        $this->symptoms = $symptoms;

        return $this;
    }

    public function getTreatment(): ?string
    {
        return $this->treatment;
    }

    public function setTreatment(?string $treatment): static
    {
        $this->treatment = $treatment;

        return $this;
    }

    public function getPrevention(): ?string
    {
        return $this->prevention;
    }

    public function setPrevention(?string $prevention): static
    {
        $this->prevention = $prevention;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Vegetable>
     */
    public function getVegetable(): Collection
    {
        return $this->vegetable;
    }

    public function addVegetable(Vegetable $vegetable): static
    {
        if (!$this->vegetable->contains($vegetable)) {
            $this->vegetable->add($vegetable);
        }

        return $this;
    }

    public function removeVegetable(Vegetable $vegetable): static
    {
        $this->vegetable->removeElement($vegetable);

        return $this;
    }
}
