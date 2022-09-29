<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert; 
#[ORM\Entity(repositoryClass: ProjetRepository::class)]

#[UniqueEntity('titre')]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'titre', type: 'string', length: 255, unique: true)]
	#[Assert\Titre]
    private ?string $titre = null;

	#[Assert\Regex(
        pattern: '/[^A-Za-z0-9]/',
        match: false,
        message: 'pas de symbole',
    )]
    #[ORM\Column(length: 255)]
    private ?int $budget = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'projets')]
    private ?User $createdBy = null;

    #[ORM\OneToMany(mappedBy: 'fundedFor', targetEntity: Financer::class, orphanRemoval: true)]
    private Collection $financers;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

 
    public function __construct()
    {
        $this->financers = new ArrayCollection();
        $this->publicationProjets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection<int, Financer>
     */
    public function getFinancers(): Collection
    {
        return $this->financers;
    }

    public function addFinancer(Financer $financer): self
    {
        if (!$this->financers->contains($financer)) {
            $this->financers->add($financer);
            $financer->setFundedFor($this);
        }

        return $this;
    }

    public function removeFinancer(Financer $financer): self
    {
        if ($this->financers->removeElement($financer)) {
            // set the owning side to null (unless already changed)
            if ($financer->getFundedFor() === $this) {
                $financer->setFundedFor(null);
            }
        }

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

 
 

}
