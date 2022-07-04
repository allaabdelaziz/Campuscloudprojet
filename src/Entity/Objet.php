<?php

namespace App\Entity;

use App\Repository\ObjetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjetRepository::class)]
class Objet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'boolean')]
    private $status;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    private $lost_adress;

    #[ORM\Column(type: 'string', length: 5)]
    private $lost_zip;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'objets')]
    #[ORM\JoinColumn(nullable: false)]
    private $User;

    #[ORM\OneToOne(mappedBy: 'Objet', targetEntity: CategoriesDetails::class, cascade: ['persist', 'remove'])]
    private $categoriesDetails;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

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

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLostAdress(): ?string
    {
        return $this->lost_adress;
    }

    public function setLostAdress(string $lost_adress): self
    {
        $this->lost_adress = $lost_adress;

        return $this;
    }

    public function getLostZip(): ?string
    {
        return $this->lost_zip;
    }

    public function setLostZip(string $lost_zip): self
    {
        $this->lost_zip = $lost_zip;

        return $this;
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

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getCategoriesDetails(): ?CategoriesDetails
    {
        return $this->categoriesDetails;
    }

    public function setCategoriesDetails(CategoriesDetails $categoriesDetails): self
    {
        // set the owning side of the relation if necessary
        if ($categoriesDetails->getObjet() !== $this) {
            $categoriesDetails->setObjet($this);
        }

        $this->categoriesDetails = $categoriesDetails;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
