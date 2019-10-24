<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use App\Entity\Country;
use App\Entity\Region;
use App\Entity\Language;
use App\Entity\Independence;
use App\Entity\Government;
use App\Entity\Flag;
use App\Entity\Coordinates;
use App\Entity\Elevation;
use App\Entity\City;
use App\Entity\Continent;

class CountryFixtures extends Fixture
{
    private $finder;
    private $bag = [];

    public function load(ObjectManager $manager)
    {
        $countries = json_decode(file_get_contents(__DIR__ . "/json/countries/country.json"), true);

        foreach ($countries as $key => $arr) {
            foreach ($arr as $k => $v) {
                $countryName = strtolower($v);
                $this->bag[$countryName] = (isset($this->bag[$countryName])) ? $this->bag[$countryName] : [];
            }
        }

        $this->fillBag('self');
        $this->fillBag('relations');

        foreach ($this->bag as $cName => $partitions) {
            $country = new Country();
            $region = new Region();
            $city = new City();
            $independence = new Independence();
            $coordinates = new Coordinates();
            $flag = new Flag();
            $government = new Government();
            $language = new Language();
            $continent = new Continent();
            $elevation = new Elevation();

            $country->setName($cName);

            foreach ($partitions as $partitionKey => $partitionValues) {
                
                foreach($partitionValues as $k => $v) {

                    if ("self" === $partitionKey) {
                        $property = array_keys($v)[0];
                        $propertyValue = $v[$property];
                        $propertyClass = "set" . ucfirst($property);
                        $country->$propertyClass($propertyValue);   
                    
                    } elseif ("relations" === $partitionKey) {

                        $entity = (gettype($k) !== 'object') ? ucfirst($k) : $entity;
                        $addMethod = "add" . $entity;
                        $setMethod = "set" . $entity;

                        if (gettype($k) !== 'object') {
                            $k = $$k;
                        }

                        foreach ($v as $relationKey => $relationValue) {
                            $property = array_keys($relationValue)[0];
                            $propertyValue = $relationValue[$property];

                            $propertyClass = "set" . ucfirst($property);
                            $k->$propertyClass($propertyValue); 
                        }

                        if (in_array($entity, ['Government','Language','Region'])) {
                            $k->addCountry($country);
                            $country->$addMethod($k);
                        
                        } else if (in_array($entity, ['Continent'])) {
                            $k->addCountry($country);
                            $country->$setMethod($k);

                        } else if (in_array($entity, ['City'])) {
                            $k->setCountry($country);
                            $country->addCity($k);

                        } else {
                            $country->$setMethod($k);
                        }

                        $manager->persist($k);
                    }

                    $manager->persist($country);
                }

            }

        }
        $manager->flush();
    }

    public function fillBag(String $type): void
    {
        $fileFinder = new Finder();
        $finder = $fileFinder->files()->in(__DIR__ . "/json/countries/$type");
        foreach ($finder as $file) {
            $fileContent = (array) json_decode(file_get_contents($file->getRealPath()));
            $fileName = str_replace('.json', '', $file->getFileName());
            foreach ($fileContent as $key => $content) {
                $c = (array) $content;
                $countryName = strtolower($c['country']);
                foreach ($c as $k => $v) {
                    if (in_array($countryName, array_keys($this->bag)) && $k !== 'country') {
                        $this->bag[$countryName][$type] = (isset($this->bag[$countryName][$type])) ? $this->bag[$countryName][$type] : [];
                        $t = [$k => $v];

                        if ($type === "relations") {
                            $this->bag[$countryName][$type][$fileName] = (isset($this->bag[$countryName][$type][$fileName])) ? $this->bag[$countryName][$type][$fileName] : [];
                            array_push($this->bag[$countryName][$type][$fileName], $t);
                        } else {
                            array_push($this->bag[$countryName][$type], $t);
                        }
                    }
                }
            }
        }
    }
}
