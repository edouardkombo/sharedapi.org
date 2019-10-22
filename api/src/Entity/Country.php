<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
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
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $callingCode;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $domain;

    /**
     * @ORM\Column(type="smallint")
     */
    private $iso;

    /**
     * @ORM\Column(type="float")
     */
    private $surface;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\City", mappedBy="country")
     */
    private $cities;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Government", inversedBy="countries")
     * @ORM\JoinTable(
     *     name="country_government",
     *     joinColumns={
     *         @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="government_id", referencedColumnName="id")
     *     }
     * )
     */
    private $governments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Language", inversedBy="countries")
     * @ORM\JoinTable(
     *     name="country_language",
     *     joinColumns={
     *         @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     *     }
     * )
     */
    private $languages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Region", inversedBy="countries")
     * @ORM\JoinTable(
     *     name="country_region",
     *     joinColumns={
     *         @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     *     }
     * )
     */
    private $regions;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Flag", mappedBy="country", cascade={"persist", "remove"})
     */
    private $flag;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Elevation", mappedBy="country", cascade={"persist", "remove"})
     */
    private $elevation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Coordinates", mappedBy="country", cascade={"persist", "remove"})
     */
    private $coordinates;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Independence", mappedBy="country", cascade={"persist", "remove"})
     */
    private $independence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Continent", inversedBy="countries")
     * @ORM\JoinColumn(nullable=true) 
     */
    private $continent;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
        $this->governments = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->regions = new ArrayCollection();
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
        $this->name = strtolower($name);

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCallingCode(): ?string
    {
        return $this->callingCode;
    }

    public function setCallingCode(?string $callingCode): self
    {
        $this->callingCode = $callingCode;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getIso(): ?int
    {
        return $this->iso;
    }

    public function setIso(?int $iso): self
    {
        $this->iso = $iso;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(?float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->setCountry($this);
        }
        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->cities->contains($city)) {
            $this->cities->removeElement($city);
            // set the owning side to null (unless already changed)
            if ($city->getCountry() === $this) {
                $city->setCountry(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Government[]
     */
    public function getGovernments(): Collection
    {
        return $this->governments;
    }

    public function addGovernment(Government $government): self
    {
        if (!$this->governments->contains($government)) {
            $this->governments->add($government);
            $government->addCountry($this);        
        }

        return $this;
    }

    public function removeGovernment(Government $government): self
    {
        if ($this->governments->contains($government)) {
            $this->governments->removeElement($government);
            $government->removeCountry($this);
        }
        
        return $this;
    }

    /**
     * @return Collection|Language[]
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Language $language): self
    {
        if (!$this->languages->contains($language)) {
            $this->languages->add($language);
            $language->addCountry($this);        
        }

        return $this;
    }

    public function removeLanguage(Language $language): self
    {
        if ($this->languages->contains($language)) {
            $this->languages->removeElement($language);
            $language->removeCountry($this);
        }
        
        return $this;
    }

    /**
     * @return Collection|Region[]
     */
    public function getRegions(): Collection
    {
        return $this->regions;
    }

    public function addRegion(Region $region): self
    {
        if (!$this->regions->contains($region)) {
            $this->regions->add($region);
            $region->addCountry($this);        
        }

        return $this;
    }

    public function removeRegion(Region $region): self
    {
        if ($this->regions->contains($region)) {
            $this->regions->removeElement($region);
            $region->removeCountry($this);
        }
        
        return $this;
    }
    
    public function getFlag(): ?Flag
    {
        return $this->flag;
    }
 
    public function setFlag(Flag $flag): self
    {
        $this->flag = $flag;
 
        return $this;
    }

    public function getElevation(): ?Elevation
    {
        return $this->elevation;
    }
 
    public function setElevation(?Elevation $elevation): self
    {
        $this->elevation = $elevation;
 
        return $this;
    }

    public function getCoordinates(): ?Coordinates
    {
        return $this->coordinates;
    }
 
    public function setCoordinates(?Coordinates $coordinates): self
    {
        $this->coordinates = $coordinates;
 
        return $this;
    }

    public function getIndependence(): ?Independence
    {
        return $this->independence;
    }
 
    public function setIndependence(?Independence $independence): self
    {
        $this->independence = $independence;
 
        return $this;
    }

    public function getContinent(): ?Continent
    {
        return $this->continent;
    }

    public function setContinent(?Continent $continent): self
    {
        $this->continent = $continent;

        return $this;
    }
}
