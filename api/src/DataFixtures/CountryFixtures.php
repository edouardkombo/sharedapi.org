<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use App\Entity\Country;

class CountryFixtures extends Fixture
{
    private $manager;
    private $finder;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->finder = new Finder();

        $this->baseTable();

        /*$values = ['female', 'male'];

        foreach ($values as $val) {
            $entity = new Gender();
            $entity->setName($val);
            $manager->persist($entity);
        }

        $manager->flush();*/
    }

    public function baseTable()
    {
        $sequence = [
            'name',
            'abbreviation',
            'domain',
            'iso-numeric',
            'surface',
            'calling-code'
        ];

        $countries = [
            'name' => []
        ];
        $finder = $this->finder->files()->in(__DIR__ . '/json')
        foreach ($finder as $filename) {
            
            /*foreach ($sequence as $file) {
                var_dump($this->finder->files()->name(__DIR__ . "/json/country-by-$filename.json"));  
                die();
            }*/          
        }

        /*$finder->files()->name('*.php');
        $countries =*/ 
    }
}
