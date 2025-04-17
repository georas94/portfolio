<?php

namespace App\Entity;

use App\Repository\AORepository;
use App\Service\AO\StatutAOUtils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AORepository::class)]
class AO
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    #[ORM\Column(length: 50)]
    private ?string $reference = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $entreprise = null;

    #[Assert\NotBlank]
    #[Assert\GreaterThan('today')]
    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $dateLimite = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?float $budget = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank]
    private ?string $statut = StatutAOUtils::DEFAULT_STATUS;

    #[ORM\OneToMany(targetEntity: AOFile::class, mappedBy: 'ao')]
    private Collection $files;

    #[ORM\OneToMany(targetEntity: Soumission::class, mappedBy: 'ao')]
    private Collection $soumissions;

    #[ORM\Column(length: 255, options: ['nullable' => true])]
    private ?string $pdfPath = null;

    #[ORM\OneToMany(targetEntity: AOLog::class, mappedBy: 'ao')]
    private Collection $logs;

    public function __construct()
    {
        $this->files = new ArrayCollection();
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

    public function setStatut(string $statut): void
    {
        $this->statut = $statut;
    }

    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(AOFile $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setAo($this);
        }
        return $this;
    }

    public function removeFile(AOFile $file): self
    {
        if ($this->files->removeElement($file)) {
            if ($file->getAo() === $this) {
                $file->setAo(null);
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

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(?string $entreprise): void
    {
        $this->entreprise = $entreprise;
    }
}