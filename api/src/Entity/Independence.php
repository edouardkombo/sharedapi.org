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
 * @ORM\Entity(repositoryClass="App\Repository\IndependenceRepository")
 */
class Independence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Country", inversedBy="independence", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=true)
     */
    private $country;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

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
