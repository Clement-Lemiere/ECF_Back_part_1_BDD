<?php

namespace App\Entity;

use App\Repository\LivresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivresRepository::class)]
class Livres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $titre = null;

    #[ORM\Column(nullable: true)]
    private ?int $annee_edition = null;

    #[ORM\Column]
    private ?int $nombre_pages = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $code_isbn = null;

    #[ORM\OneToMany(mappedBy: 'livres', targetEntity: Emprunt::class)]
    private Collection $emprunt_id;

    #[ORM\OneToMany(mappedBy: 'livres_id', targetEntity: Emprunt::class)]
    private Collection $emprunts;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Auteur $auteur = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'livres')]
    private Collection $genres;

    public function __construct()
    {
        $this->emprunt_id = new ArrayCollection();
        $this->emprunts = new ArrayCollection();
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAnneeEdition(): ?int
    {
        return $this->annee_edition;
    }

    public function setAnneeEdition(?int $annee_edition): static
    {
        $this->annee_edition = $annee_edition;

        return $this;
    }

    public function getNombrePages(): ?int
    {
        return $this->nombre_pages;
    }

    public function setNombrePages(int $nombre_pages): static
    {
        $this->nombre_pages = $nombre_pages;

        return $this;
    }

    public function getCodeIsbn(): ?string
    {
        return $this->code_isbn;
    }

    public function setCodeIsbn(?string $code_isbn): static
    {
        $this->code_isbn = $code_isbn;

        return $this;
    }

    /**
     * @return Collection<int, Emprunt>
     */
    public function getEmpruntId(): Collection
    {
        return $this->emprunt_id;
    }

    public function addEmpruntId(Emprunt $empruntId): static
    {
        if (!$this->emprunt_id->contains($empruntId)) {
            $this->emprunt_id->add($empruntId);
            $empruntId->setLivres($this);
        }

        return $this;
    }

    public function removeEmpruntId(Emprunt $empruntId): static
    {
        if ($this->emprunt_id->removeElement($empruntId)) {
            // set the owning side to null (unless already changed)
            if ($empruntId->getLivres() === $this) {
                $empruntId->setLivres(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Emprunt>
     */
    public function getEmprunts(): Collection
    {
        return $this->emprunts;
    }

    public function addEmprunt(Emprunt $emprunt): static
    {
        if (!$this->emprunts->contains($emprunt)) {
            $this->emprunts->add($emprunt);
            $emprunt->setLivresId($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): static
    {
        if ($this->emprunts->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getLivresId() === $this) {
                $emprunt->setLivresId(null);
            }
        }

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }
}
