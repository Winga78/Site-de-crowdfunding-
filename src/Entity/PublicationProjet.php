<?php

namespace App\Entity;

use App\Repository\PublicationProjetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicationProjetRepository::class)]
class PublicationProjet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'publicationProjets')]
    private ?Projet $getProjet = null;

    #[ORM\ManyToOne(inversedBy: 'publicationProjets')]
    private ?Financer $financedBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGetProjet(): ?Projet
    {
        return $this->getProjet;
    }

    public function setGetProjet(?Projet $getProjet): self
    {
        $this->getProjet = $getProjet;

        return $this;
    }

    public function getFinancedBy(): ?Financer
    {
        return $this->financedBy;
    }

    public function setFinancedBy(?Financer $financedBy): self
    {
        $this->financedBy = $financedBy;

        return $this;
    }
}
