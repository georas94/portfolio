<?php

namespace App\Entity;

use App\Repository\AOFileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AOFileRepository::class)]
class AOFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column(length: 255)]
    private ?string $originalFilename = null;

    #[ORM\ManyToOne(inversedBy: 'aOFichiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AO $ao = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getOriginalFilename(): ?string
    {
        return $this->originalFilename;
    }

    public function setOriginalFilename(string $originalFilename): static
    {
        $this->originalFilename = $originalFilename;

        return $this;
    }

    public function getAo(): ?AO
    {
        return $this->ao;
    }

    public function setAo(?AO $ao): static
    {
        $this->ao = $ao;

        return $this;
    }
}
