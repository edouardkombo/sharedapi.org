<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoordinatesRepository")
 */
class Coordinates
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $north;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $south;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $east;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $west;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNorth(): ?string
    {
        return $this->north;
    }

    public function setNorth(?string $north): self
    {
        $this->north = $north;

        return $this;
    }

    public function getSouth(): ?string
    {
        return $this->south;
    }

    public function setSouth(?string $south): self
    {
        $this->south = $south;

        return $this;
    }

    public function getEast(): ?string
    {
        return $this->east;
    }

    public function setEast(?string $east): self
    {
        $this->east = $east;

        return $this;
    }

    public function getWest(): ?string
    {
        return $this->west;
    }

    public function setWest(?string $west): self
    {
        $this->west = $west;

        return $this;
    }
}
