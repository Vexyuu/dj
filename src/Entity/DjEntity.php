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

const SECURITY_AUTHENTICATED = "is_granted('IS_AUTHENTICATED_FULLY')";

#[ORM\Entity(repositoryClass: DjEntityRepository::class)]
#[ApiResource(
    stateless: false,
    operations: [
        new GetCollection(security: SECURITY_AUTHENTICATED),
        new Post(security: SECURITY_AUTHENTICATED),
        new Get(security: SECURITY_AUTHENTICATED),
        new Put(security: SECURITY_AUTHENTICATED),
        new Delete(security: SECURITY_AUTHENTICATED)
    ]
)]
class DjEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $urlPortfolio = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateSoiree = null;

    #[ORM\Column]
    private ?bool $materiel = null;

    #[ORM\Column(length: 255)]
    private ?string $couleur = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column]
    private ?int $nbEnceintes = null;

    #[ORM\Column]
    private ?int $puissance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;
        return $this;
    }

    public function getUrlPortfolio(): ?string
    {
        return $this->urlPortfolio;
    }

    public function setUrlPortfolio(string $urlPortfolio): static
    {
        $this->urlPortfolio = $urlPortfolio;
        return $this;
    }

    public function getDateSoiree(): ?\DateTime
    {
        return $this->dateSoiree;
    }

    public function setDateSoiree(\DateTime $dateSoiree): static
    {
        $this->dateSoiree = $dateSoiree;
        return $this;
    }

    public function isMateriel(): ?bool
    {
        return $this->materiel;
    }

    public function setMateriel(bool $materiel): static
    {
        $this->materiel = $materiel;
        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;
        return $this;
    }

    public function getNbEnceintes(): ?int
    {
        return $this->nbEnceintes;
    }

    public function setNbEnceintes(int $nbEnceintes): static
    {
        $this->nbEnceintes = $nbEnceintes;
        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): static
    {
        $this->puissance = $puissance;
        return $this;
    }
}
