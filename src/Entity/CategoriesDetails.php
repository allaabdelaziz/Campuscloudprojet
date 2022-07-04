<?php

namespace App\Entity;

use App\Repository\CategoriesDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesDetailsRepository::class)]
class CategoriesDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'categoriesDetails')]
    private $Categorie;

    #[ORM\OneToOne(inversedBy: 'categoriesDetails', targetEntity: Objet::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $Objet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categories $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getObjet(): ?Objet
    {
        return $this->Objet;
    }

    public function setObjet(Objet $Objet): self
    {
        $this->Objet = $Objet;

        return $this;
    }
}
