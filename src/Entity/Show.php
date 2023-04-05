<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping\JoinColumn;


#[ORM\Entity(repositoryClass: ShowRepository::class)]
#[ORM\Table(name:"shows")]
#[UniqueEntity(fields:["slug"])]
class Show
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poster_url = null;

    #[ORM\ManyToOne(inversedBy: 'shows')]
    #[ORM\JoinColumn(onDelete: 'RESTRICT')]
    private ?Location $location = null;

    #[ORM\Column]
    private ?bool $bookable = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 12, scale: 2, nullable: true)]
    private ?string $price = null;

    #[ORM\OneToMany(mappedBy: 'the_show', targetEntity: Representation::class, orphanRemoval: true)]
    private Collection $representions;

    public function __construct()
    {
        $this->representions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPosterUrl(): ?string
    {
        return $this->poster_url;
    }

    public function setPosterUrl(?string $poster_url): self
    {
        $this->poster_url = $poster_url;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function isBookable(): ?bool
    {
        return $this->bookable;
    }

    public function setBookable(bool $bookable): self
    {
        $this->bookable = $bookable;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Representation>
     */
    public function getRepresentions(): Collection
    {
        return $this->representions;
    }

    public function addRepresention(Representation $represention): self
    {
        if (!$this->representions->contains($represention)) {
            $this->representions->add($represention);
            $represention->setTheShow($this);
        }

        return $this;
    }

    public function removeRepresention(Representation $represention): self
    {
        if ($this->representions->removeElement($represention)) {
            // set the owning side to null (unless already changed)
            if ($represention->getTheShow() === $this) {
                $represention->setTheShow(null);
            }
        }

        return $this;
    }
}
