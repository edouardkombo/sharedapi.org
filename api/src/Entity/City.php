<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=70)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $capital;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="cities")
     * @ORM\JoinColumn(nullable=true) 
     */
    private $country;

    public function __construct()
    {
        $this->capital = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = strtolower($name);

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getCapital(): ?bool
    {
        return $this->capital;
    }

    public function setCapital(?bool $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
