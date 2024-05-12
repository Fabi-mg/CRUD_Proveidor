<?php

namespace App\Entity;

use App\Repository\ProveidorsRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProveidorsRepository::class)]
class Proveidors
{
    //Propietats
    const TYPES = [
        'Hotel' => 'Hotel',
        'Pista' => 'Pista',
        'Complement' => 'Complement'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 9)]
    private ?string $telf = null;

    #[ORM\Column]
    private ?string $tipus;

    #[ORM\Column]
    private ?bool $actiu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $incorporacio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $edicio = null;

    // Constructors
    public function __construct($nom = null, $email = null, $telf = null, $tipus = null, $actiu = null) {

        $this->nom = $nom;
        $this->email = $email;
        $this->telf = $telf;
        $this->tipus = $tipus;
        $this->actiu = $actiu;
        $this->incorporacio = new DateTime();

    }

    //Getters i setters
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelf(): ?string
    {
        return $this->telf;
    }

    public function setTelf(string $telf): static
    {
        $this->telf = $telf;

        return $this;
    }

    public function getTipus(): ?string
    {
        return $this->tipus;
    }

    public function setTipus(?string $tipus): static
    {
        $this->tipus = $tipus;
    
        return $this;
    }

    public function isActiu(): ?bool
    {
        return $this->actiu;
    }

    public function setActiu(bool $actiu): static
    {
        $this->actiu = $actiu;

        return $this;
    }

    public function getIncorporacio(): ?\DateTimeInterface
    {
        return $this->incorporacio;
    }

    public function setIncorporacio(\DateTimeInterface $incorporacio): static
    {
        $this->incorporacio = $incorporacio;

        return $this;
    }

    public function getEdicio(): ?\DateTimeInterface
    {
        return $this->edicio;
    }

    public function setEdicio(?\DateTimeInterface $edicio): static
    {
        $this->edicio = $edicio;

        return $this;
    }
}
