<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use Doctrine\Common\Collections\Collection;
use App\Repository\CategoriesDetailsRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategoriesDetailsRepository::class)]
class CategoriesDetails
{
    use CreatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'categoriesDetails')]
    private $Categorie;

    #[ORM\OneToMany(mappedBy: 'categoryDetails', targetEntity: Objet::class)]
    private $objets;

    public function __construct()
    {
        $this->objets = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();

    }
    
    public function __toString()
    {
        return $this->id;
    }

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



    /**
     * @return Collection<int, Objet>
     */
    public function getObjets(): Collection
    {
        return $this->objets;
    }

    public function addObjet(Objet $objet): self
    {
        if (!$this->objets->contains($objet)) {
            $this->objets[] = $objet;
            $objet->setCategoryDetails($this);
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getCategoryDetails() === $this) {
                $objet->setCategoryDetails(null);
            }
        }

        return $this;
    }
}
