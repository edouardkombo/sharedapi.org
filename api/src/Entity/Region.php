<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
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
 */
class Region
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Country", mappedBy="regions")
     * @ApiSubresource(maxDepth=1)
     */
    private $countries;


    public function __construct()
    {
        $this->countries = new ArrayCollection();
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

    /**
     * @return Collection|Country[]
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    public function addCountry(Country $country): self
    {
        if (!$this->countries->contains($country)) {
            $this->countries->add($country);
            $country->addRegion($this);        
        }

        return $this;
    }

    public function removeCountry(Country $country): self
    {
        if ($this->countries->contains($country)) {
            $this->countries->removeElement($country);
            $country->removeRegion($this);
        }

        return $this;
    }
}
