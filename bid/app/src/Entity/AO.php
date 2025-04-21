<?php

namespace App\Entity;

use App\Repository\AORepository;
use App\Service\AO\StatutAOUtils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AORepository::class)]
#[ORM\Table(name: "ao")]
class AO
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    #[ORM\Column(length: 50)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?string $reference = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[ORM\Column(length: 255)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?string $titre = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?string $description = null;

    #[Assert\NotNull]
    #[ORM\ManyToOne(targetEntity: Entreprise::class, inversedBy: 'appelsOffre')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?Entreprise $entreprise = null;

    #[Assert\NotBlank]
    #[Assert\GreaterThan('now')]
    #[ORM\Column(type: 'datetime')]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?\DateTimeInterface $dateLimite = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?float $budget = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 20)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?string $statut = StatutAOUtils::STATUS_DRAFT;

    #[ORM\OneToMany(targetEntity: AODocument::class, mappedBy: 'ao', cascade: ['persist', 'remove'])]
    private Collection $documents;

    #[ORM\OneToMany(targetEntity: Soumission::class, mappedBy: 'ao')]
    private Collection $soumissions;

    #[ORM\Column(length: 255, options: ['nullable' => true])]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?string $pdfPath = null;

    #[ORM\OneToMany(targetEntity: AOLog::class, mappedBy: 'ao')]
    private Collection $logs;

    #[Assert\NotNull]
    #[ORM\Column(type: Types::JSON)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private array $location = []; // [latitude, longitude]

    #[Assert\NotNull]
    #[Assert\Type('array')]
    #[Assert\Collection(
        fields: [
            'rayon' => new Assert\Required([new Assert\Positive()]),
            'secteurs' => new Assert\Required([new Assert\Type('array')])
        ]
    )]
    #[ORM\Column(type: 'json')]
    private array $zoneImpact = ['rayon' => 10, 'secteurs' => []];

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->logs = new ArrayCollection();
    }

    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): void
    {
        $this->titre = $titre;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDateLimite(): ?\DateTimeInterface
    {
        return $this->dateLimite;
    }

    public function setDateLimite(?\DateTimeInterface $dateLimite): void
    {
        $this->dateLimite = $dateLimite;
    }

    public function getBudget(): ?float
    {
        return $this->budget;
    }

    public function setBudget(?float $budget): void
    {
        $this->budget = $budget;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function getStatutToPrint(): ?string
    {
        return StatutAOUtils::STATUTS[$this->statut] ?? null;
    }

    public function setStatut(string $statut): void
    {
        $this->statut = $statut;
    }

    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(AODocument $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setAo($this);
        }
        return $this;
    }

    public function removeDocument(AODocument $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getAo() === $this) {
                $document->setAo(null);
            }
        }
        return $this;
    }

    public function getSoumissions(): Collection
    {
        return $this->soumissions;
    }

    public function setSoumissions(Collection $soumissions): void
    {
        $this->soumissions = $soumissions;
    }

    public function getPdfPath(): ?string
    {
        return $this->pdfPath;
    }

    public function setPdfPath(?string $pdfPath): void
    {
        $this->pdfPath = $pdfPath;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;
        return $this;
    }

    public function getLocation(): array
    {
        return $this->location;
    }

    public function setLocation(float $latitude, float $longitude): void
    {
        $this->location = [
            'lat' => $latitude,
            'lng' => $longitude
        ];
    }

    public function getZoneImpact(): array
    {
        return $this->zoneImpact;
    }

    public function setZoneImpact(array $zoneImpact): void
    {
        $this->zoneImpact = $zoneImpact;
    }

    public function getLatitude(): ?float
    {
        return $this->coordinates['lat'] ?? null;
    }

    public function getLongitude(): ?float
    {
        return $this->coordinates['lng'] ?? null;
    }
}