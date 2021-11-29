<?php

namespace App\Entity;

use App\Repository\CataloguesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CataloguesRepository::class)
 */
class Catalogues
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 5, max=255, minMessage="Le titre est trop court")
     */
    private $Titre;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min = 5)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;

    /**
     * @ORM\Column(type="integer")
     */
    private $Date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDate(): ?int
    {
        return $this->Date;
    }

    public function setDate(int $Date): self
    {
        $this->Date = $Date;

        return $this;
    }
}
