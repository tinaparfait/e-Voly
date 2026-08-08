<?php

namespace App\Entity;

use App\Repository\VegetableRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VegetableRepository::class)]
class Vegetable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $scientificName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $difficulty = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $soilType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sunlight = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $watering = null;

    #[ORM\Column(nullable: true)]
    private ?int $germinationDays = null;

    #[ORM\Column(nullable: true)]
    private ?int $harvestDays = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'vegetables')]
    private ?Category $category = null;

    /**
     * @var Collection<int, CultivationStep>
     */
    #[ORM\OneToMany(targetEntity: CultivationStep::class, mappedBy: 'vegetable')]
    private Collection $cultivationSteps;

    /**
     * @var Collection<int, Tip>
     */
    #[ORM\OneToMany(targetEntity: Tip::class, mappedBy: 'vegetable')]
    private Collection $tips;

    /**
     * @var Collection<int, Disease>
     */
    #[ORM\ManyToMany(targetEntity: Disease::class, mappedBy: 'vegetable')]
    private Collection $diseases;

    /**
     * @var Collection<int, Season>
     */
    #[ORM\ManyToMany(targetEntity: Season::class, mappedBy: 'vegetable')]
    private Collection $seasons;

    public function __construct()
    {
        $this->cultivationSteps = new ArrayCollection();
        $this->tips = new ArrayCollection();
        $this->diseases = new ArrayCollection();
        $this->seasons = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
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

    public function getScientificName(): ?string
    {
        return $this->scientificName;
    }

    public function setScientificName(?string $scientificName): static
    {
        $this->scientificName = $scientificName;

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

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): static
    {
        $this->difficulty = $difficulty;

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

    public function getSoilType(): ?string
    {
        return $this->soilType;
    }

    public function setSoilType(?string $soilType): static
    {
        $this->soilType = $soilType;

        return $this;
    }

    public function getSunlight(): ?string
    {
        return $this->sunlight;
    }

    public function setSunlight(?string $sunlight): static
    {
        $this->sunlight = $sunlight;

        return $this;
    }

    public function getWatering(): ?string
    {
        return $this->watering;
    }

    public function setWatering(?string $watering): static
    {
        $this->watering = $watering;

        return $this;
    }

    public function getGerminationDays(): ?int
    {
        return $this->germinationDays;
    }

    public function setGerminationDays(?int $germinationDays): static
    {
        $this->germinationDays = $germinationDays;

        return $this;
    }

    public function getHarvestDays(): ?int
    {
        return $this->harvestDays;
    }

    public function setHarvestDays(?int $harvestDays): static
    {
        $this->harvestDays = $harvestDays;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, CultivationStep>
     */
    public function getCultivationSteps(): Collection
    {
        return $this->cultivationSteps;
    }

    public function addCultivationStep(CultivationStep $cultivationStep): static
    {
        if (!$this->cultivationSteps->contains($cultivationStep)) {
            $this->cultivationSteps->add($cultivationStep);
            $cultivationStep->setVegetable($this);
        }

        return $this;
    }

    public function removeCultivationStep(CultivationStep $cultivationStep): static
    {
        if ($this->cultivationSteps->removeElement($cultivationStep)) {
            // set the owning side to null (unless already changed)
            if ($cultivationStep->getVegetable() === $this) {
                $cultivationStep->setVegetable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tip>
     */
    public function getTips(): Collection
    {
        return $this->tips;
    }

    public function addTip(Tip $tip): static
    {
        if (!$this->tips->contains($tip)) {
            $this->tips->add($tip);
            $tip->setVegetable($this);
        }

        return $this;
    }

    public function removeTip(Tip $tip): static
    {
        if ($this->tips->removeElement($tip)) {
            // set the owning side to null (unless already changed)
            if ($tip->getVegetable() === $this) {
                $tip->setVegetable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Disease>
     */
    public function getDiseases(): Collection
    {
        return $this->diseases;
    }

    public function addDisease(Disease $disease): static
    {
        if (!$this->diseases->contains($disease)) {
            $this->diseases->add($disease);
            $disease->addVegetable($this);
        }

        return $this;
    }

    public function removeDisease(Disease $disease): static
    {
        if ($this->diseases->removeElement($disease)) {
            $disease->removeVegetable($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Season>
     */
    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(Season $season): static
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons->add($season);
            $season->addVegetable($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): static
    {
        if ($this->seasons->removeElement($season)) {
            $season->removeVegetable($this);
        }

        return $this;
    }
}
