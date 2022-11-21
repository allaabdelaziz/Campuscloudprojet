<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ObjetRepository;
use App\Entity\Trait\CreatedAtTrait;

#[ORM\Entity(repositoryClass: ObjetRepository::class)]
class Objet
{
    use CreatedAtTrait;
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




    #[ORM\Column(type: 'boolean')]
    private $active;

    #[ORM\Column(type: 'boolean')]
    private $isfound;

    #[ORM\Column(type: 'string', length: 255)]
    private $clues;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'objets')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToOne(targetEntity: CategoriesDetails::class, inversedBy: 'objets')]
    private $categoryDetails;

    #[ORM\Column(type: 'date', nullable: true)]
    private $LostDate;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    private $lostCity;

    
    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isIsfound(): ?bool
    {
        return $this->isfound;
    }

    public function setIsfound(bool $isfound): self
    {
        $this->isfound = $isfound;

        return $this;
    }

    public function getClues(): ?string
    {
        return $this->clues;
    }

    public function setClues(string $clues): self
    {
        $this->clues = $clues;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCategoryDetails(): ?CategoriesDetails
    {
        return $this->categoryDetails;
    }

    public function setCategoryDetails(?CategoriesDetails $categoryDetails): self
    {
        $this->categoryDetails = $categoryDetails;

        return $this;
    }

    public function getLostDate(): ?\DateTimeInterface
    {
        return $this->LostDate;
    }

    public function setLostDate(?\DateTimeInterface $LostDate): self
    {
        $this->LostDate = $LostDate;

        return $this;
    }

    public function getLostCity(): ?string
    {
        return $this->lostCity;
    }

    public function setLostCity(?string $lostCity): self
    {
        $this->lostCity = $lostCity;

        return $this;
    }
    public function __toString()
    {
        return $this->id;
    }
}
