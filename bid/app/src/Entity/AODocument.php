<?php

namespace App\Entity;

use App\Repository\AODocumentRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AODocumentRepository::class)]
#[Vich\Uploadable]
class AODocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?AO $ao = null;

    #[Vich\UploadableField(mapping: 'ao_documents', fileNameProperty: 'fileName', size: 'fileSize')]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?File $file = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?string $fileName = null;

    #[ORM\Column]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?int $fileSize = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?string $originalName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?string $mimeType = null;

    #[ORM\Column]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?DateTimeImmutable $uploadedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getAo(): ?AO
    {
        return $this->ao;
    }

    public function setAo(?AO $ao): void
    {
        $this->ao = $ao;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): void
    {
        $this->file = $file;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    public function setFileSize(?int $fileSize): void
    {
        $this->fileSize = $fileSize;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): void
    {
        $this->originalName = $originalName;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(?string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    public function getUploadedAt(): ?DateTimeImmutable
    {
        return $this->uploadedAt;
    }

    public function setUploadedAt(?DateTimeImmutable $uploadedAt): void
    {
        $this->uploadedAt = $uploadedAt;
    }
}