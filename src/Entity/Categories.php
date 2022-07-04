<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\OneToOne(targetEntity: Objet::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $Objet;

    #[ORM\OneToMany(mappedBy: 'Categorie', targetEntity: CategoriesDetails::class)]
    private $categoriesDetails;

    public function __construct()
    {
        $this->categoriesDetails = new ArrayCollection();
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

    public function getObjet(): ?Objet
    {
        return $this->Objet;
    }

    public function setObjet(Objet $Objet): self
    {
        $this->Objet = $Objet;

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
}
