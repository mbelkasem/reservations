<?php

namespace App\Entity;

use App\Repository\ArtistsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArtistsRepository::class)]
#[ORM\Table(name:"artists")]
class Artists
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    #[Assert\Length(
        min: 2,
        max: 60,
        minMessage: 'Your firstname must be at least {{ limit }} characters long',
       // maxMessage: 'Your firstname cannot be longer than {{ limit }} characters',
    )]

    private ?string $firstname = null;

    #[ORM\Column(length: 60)]
    #[Assert\Length(
        min: 2,
        max: 60,
        minMessage: 'Your lastname must be at least {{ limit }} characters long',
       // maxMessage: 'Your lastname cannot be longer than {{ limit }} characters',
    )]

    private ?string $lastname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }
}
