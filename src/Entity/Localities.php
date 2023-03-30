<?php

namespace App\Entity;

use App\Repository\LocalitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocalitiesRepository::class)]
#[ORM\Table(name:"localities")]
class Localities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 6)]
    private ?string $postal_code = null;

    #[ORM\Column(length: 60)]
    private ?string $locality = null;

    #[ORM\OneToMany(mappedBy: 'locality', targetEntity: Locations::class)]
    private Collection $locations;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * @return Collection<int, Locations>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Locations $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setLocality($this);
        }

        return $this;
    }

    public function removeLocation(Locations $location): self
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getLocality() === $this) {
                $location->setLocality(null);
            }
        }

        return $this;
    }
}
