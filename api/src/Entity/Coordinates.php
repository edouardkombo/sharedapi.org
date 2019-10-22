<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="has_role('ROLE_ADMIN')"}
 *     },
 *     itemOperations={
 *         "get",
 *         "put"={"access_control"="is_granted('ROLE_ADMIN', previous_object)"},
 *         "delete"={"access_control"="is_granted('ROLE_ADMIN', previous_object)"}
 *     },
 *     graphql={
 *          "query",
 *          "delete"={"access_control"="is_granted('ROLE_ADMIN', previous_object)"},
 *          "update"={"access_control"="is_granted('ROLE_ADMIN', previous_object)"},
 *          "collection_query",
 *          "create"={"access_control"="is_granted('ROLE_ADMIN', previous_object)"}
 *     }     
 * )
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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Country", inversedBy="coordinates", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=true)
     */
    private $country;

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

    public function getCountry(): Country
    {
        return $this->country;
    }
 
    public function setCountry(Country $country): self
    {
        $this->country = $country;
 
        return $this;
    }
}
