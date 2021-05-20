<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $originalName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsis;

    /**
     * @ORM\ManyToMany(targetEntity=Actor::class, inversedBy="movies")
     */
    private $actors;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="movies")
     */
    private $genres;

    /**
     * @ORM\ManyToOne(targetEntity=Studio::class, inversedBy="movies")
     */
    private $studio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="seenMovies")
     */
    private $seen;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="watchList")
     * @ORM\JoinTable(name="user_watchList")
     */
    private $watchList;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->seen = new ArrayCollection();
        $this->watchList = new ArrayCollection();
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

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): self
    {
        $this->originalName = $originalName;

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

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return Collection|actor[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
        }

        return $this;
    }

    public function removeActor(actor $actor): self
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    /**
     * @return Collection|genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function getStudio(): ?studio
    {
        return $this->studio;
    }

    public function setStudio(?studio $studio): self
    {
        $this->studio = $studio;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getSeen(): Collection
    {
        return $this->seen;
    }

    public function addSeen(user $seen): self
    {
        if (!$this->seen->contains($seen)) {
            $this->seen[] = $seen;
        }

        return $this;
    }

    public function removeSeen(user $seen): self
    {
        $this->seen->removeElement($seen);

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getWatchList(): Collection
    {
        return $this->watchList;
    }

    public function addWatchList(user $watchList): self
    {
        if (!$this->watchList->contains($watchList)) {
            $this->watchList[] = $watchList;
        }

        return $this;
    }

    public function removeWatchList(user $watchList): self
    {
        $this->watchList->removeElement($watchList);

        return $this;
    }
}
