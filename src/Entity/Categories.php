<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    use CreatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;



    #[ORM\OneToMany(mappedBy: 'Categorie', targetEntity: CategoriesDetails::class)]
    private $categoriesDetails;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Objet::class)]
    private $objets;

    public function __construct()
    {
        $this->categoriesDetails = new ArrayCollection();
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



    /**
     * @return Collection<int, CategoriesDetails>
     */
    public function getCategoriesDetails(): Collection
    {
        return $this->categoriesDetails;
    }

    public function addCategoriesDetail(CategoriesDetails $categoriesDetail): self
    {
        if (!$this->categoriesDetails->contains($categoriesDetail)) {
            $this->categoriesDetails[] = $categoriesDetail;
            $categoriesDetail->setCategorie($this);
        }

        return $this;
    }

    public function removeCategoriesDetail(CategoriesDetails $categoriesDetail): self
    {
        if ($this->categoriesDetails->removeElement($categoriesDetail)) {
            // set the owning side to null (unless already changed)
            if ($categoriesDetail->getCategorie() === $this) {
                $categoriesDetail->setCategorie(null);
            }
        }

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
            $objet->setCategory($this);
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getCategory() === $this) {
                $objet->setCategory(null);
            }
        }

        return $this;
    }
}
