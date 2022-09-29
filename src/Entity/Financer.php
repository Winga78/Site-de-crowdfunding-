<?php

namespace App\Entity;

use App\Repository\FinancerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FinancerRepository::class)]
class Financer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
	#[Assert\Regex(pattern	: '$',
	match : false,
	message : 'pas besoin de rajouter $',)]
    private ?int $montant = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'financers')]
    private ?User $fundedBy = null;

    #[ORM\ManyToOne(inversedBy: 'financers')]
    private ?Projet $fundedFor = null;

 

    public function __construct()
    {
        $this->publicationProjets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getFundedBy(): ?User
    {
        return $this->fundedBy;
    }

    public function setFundedBy(?User $fundedBy): self
    {
        $this->fundedBy = $fundedBy;

        return $this;
    }

    public function getFundedFor(): ?Projet
    {
        return $this->fundedFor;
    }

    public function setFundedFor(?Projet $fundedFor): self
    {
        $this->fundedFor = $fundedFor;

        return $this;
    }


	
}
