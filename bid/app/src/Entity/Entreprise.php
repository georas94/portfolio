<?php

namespace App\Entity;

use App\Enum\SectorEnum;
use App\Repository\EntrepriseRepository;
use App\ValueObject\Sector;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
#[ORM\Table(name: "entreprise")]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private string $nom;

    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    #[ORM\Column(type: "string", length: 20)]
    private string $sectorCode;

    #[ORM\Column(type: "text", nullable: true)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    private ?string $logo = null;

    #[ORM\OneToMany(targetEntity: AO::class, mappedBy: "entreprise")]
    private Collection $aos;

    #[ORM\OneToMany(targetEntity: AO::class, mappedBy: 'entreprise')]
    private Collection $appelsOffre;

    public function __construct()
    {
        $this->aos = new ArrayCollection();
        $this->appelsOffre = new ArrayCollection();
    }

    // Getters/Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getSectorCode(): Sector
    {
        return SectorEnum::getSector($this->sectorCode);
    }

    public function setSectorCode(Sector $sectorCode): void
    {
        $this->sectorCode = $sectorCode->getCode();
    }

    #[Groups(['ao:list', 'ao:edit', 'ao:detail'])]
    public function getSectorCodeData(): array
    {
        return [
            'code' => $this->sectorCode,
            'label' => $this->getSectorCode()->getLabel(),
            'category' => $this->getSectorCode()->getCategory(),
        ];
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;
        return $this;
    }

    public function getAos(): Collection
    {
        return $this->aos;
    }

    public function addAo(Ao $ao): self
    {
        if (!$this->aos->contains($ao)) {
            $this->aos[] = $ao;
            $ao->setEntreprise($this);
        }
        return $this;
    }

    public function removeAo(Ao $ao): self
    {
        if ($this->aos->removeElement($ao)) {
            if ($ao->getEntreprise() === $this) {
                $ao->setEntreprise(null);
            }
        }
        return $this;
    }
    public function getAppelsOffre(): Collection
    {
        return $this->appelsOffre;
    }

    public function addAppelOffre(AO $appelOffre): self
    {
        if (!$this->appelsOffre->contains($appelOffre)) {
            $this->appelsOffre[] = $appelOffre;
            $appelOffre->setEntreprise($this);
        }
        return $this;
    }

    public function removeAppelOffre(AO $appelOffre): self
    {
        if ($this->appelsOffre->removeElement($appelOffre)) {
            // set the owning side to null (unless already changed)
            if ($appelOffre->getEntreprise() === $this) {
                $appelOffre->setEntreprise(null);
            }
        }
        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }
}