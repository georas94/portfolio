<?php

namespace App\Entity;

use App\Repository\SoumissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SoumissionRepository::class)]
class Soumission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $entreprise = null;

    #[ORM\ManyToOne(targetEntity: AO::class, inversedBy: 'soumissions')]
    private ?AO $ao = null;

//    #[ORM\OneToMany(targetEntity: SoumissionFichier::class, mappedBy: 'soumission')]
//    private Collection $fichiers;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $dateSoumission = null;

    #[ORM\Column(length: 20)]
    private ?string $statut = 'En cours';
    #[ORM\Column(length: 255, options: ['default' => null])]
    private ?string $pdfPath = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getEntreprise(): ?User
    {
        return $this->entreprise;
    }

    public function setEntreprise(?User $entreprise): void
    {
        $this->entreprise = $entreprise;
    }

    public function getAo(): ?AO
    {
        return $this->ao;
    }

    public function setAo(?AO $ao): void
    {
        $this->ao = $ao;
    }

//    public function getFichiers(): Collection
//    {
//        return $this->fichiers;
//    }
//
//    public function setFichiers(Collection $fichiers): void
//    {
//        $this->fichiers = $fichiers;
//    }

    public function getDateSoumission(): ?\DateTimeInterface
    {
        return $this->dateSoumission;
    }

    public function setDateSoumission(?\DateTimeInterface $dateSoumission): void
    {
        $this->dateSoumission = $dateSoumission;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): void
    {
        $this->statut = $statut;
    } // En cours/Validé/Rejeté

    public function setPdfPath(?string $pdfPath): void
    {
        $this->pdfPath = $pdfPath;
    }
    public function getPdfPath(): ?string
    {
        return $this->pdfPath;
    }
}