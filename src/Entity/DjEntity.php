<?php

namespace App\Entity;
use ApiPlatform\Metadata\ApiResource;

use App\Repository\DjEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: DjEntityRepository::class)]
#[ApiResource(
    stateless : false,
    operations: [
        new GetCollection(security: "is_granted('IS_AUTHENTICATED_FULLY')"),
        new Post(security: "is_granted('IS_AUTHENTICATED_FULLY')"),
        new Get(security: "is_granted('IS_AUTHENTICATED_FULLY')"),
        new Put(security: "is_granted('IS_AUTHENTICATED_FULLY')"),
        new Delete(security: "is_granted('IS_AUTHENTICATED_FULLY')")
    ]
)]
class DjEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $Tel = null;

    #[ORM\Column(length: 255)]
    private ?string $UrlPortfolio = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $DateSoiree = null;

    #[ORM\Column]
    private ?bool $Materiel = null;

    #[ORM\Column(length: 255)]
    private ?string $Couleur = null;

    #[ORM\Column(length: 255)]
    private ?string $Photo = null;

    #[ORM\Column]
    private ?int $NbEnceintes = null;

    #[ORM\Column]
    private ?int $Puissance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(string $Tel): static
    {
        $this->Tel = $Tel;

        return $this;
    }

    public function getUrlPortfolio(): ?string
    {
        return $this->UrlPortfolio;
    }

    public function setUrlPortfolio(string $UrlPortfolio): static
    {
        $this->UrlPortfolio = $UrlPortfolio;

        return $this;
    }

    public function getDateSoiree(): ?\DateTime
    {
        return $this->DateSoiree;
    }

    public function setDateSoiree(\DateTime $DateSoiree): static
    {
        $this->DateSoiree = $DateSoiree;

        return $this;
    }

    public function isMateriel(): ?bool
    {
        return $this->Materiel;
    }

    public function setMateriel(bool $Materiel): static
    {
        $this->Materiel = $Materiel;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->Couleur;
    }

    public function setCouleur(string $Couleur): static
    {
        $this->Couleur = $Couleur;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(string $Photo): static
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getNbEnceintes(): ?int
    {
        return $this->NbEnceintes;
    }

    public function setNbEnceintes(int $NbEnceintes): static
    {
        $this->NbEnceintes = $NbEnceintes;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->Puissance;
    }

    public function setPuissance(int $Puissance): static
    {
        $this->Puissance = $Puissance;

        return $this;
    }
}
