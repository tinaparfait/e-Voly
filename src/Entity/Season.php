<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $startMonth = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $endMonth = null;

    /**
     * @var Collection<int, Vegetable>
     */
    #[ORM\ManyToMany(targetEntity: Vegetable::class, mappedBy: 'seasons')]
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStartMonth(): ?string
    {
        return $this->startMonth;
    }

    public function setStartMonth(?string $startMonth): static
    {
        $this->startMonth = $startMonth;

        return $this;
    }

    public function getEndMonth(): ?string
    {
        return $this->endMonth;
    }

    public function setEndMonth(?string $endMonth): static
    {
        $this->endMonth = $endMonth;

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
