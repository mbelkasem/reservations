<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Localities;

class LocalityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $localities = [
            ['postal_code'=>'1000','locality'=>'Bruxelles'],
            ['postal_code'=>'1020','locality'=>'Laeken'],
            ['postal_code'=>'1030','locality'=>'Schaerbeek'],
            ['postal_code'=>'1050','locality'=>'Ixelles'],
            ['postal_code'=>'1070','locality'=>'Anderlecht'],
                       
        ];

        foreach ($localities as $record) {
            $localities = new Localities();
            $localities->setPostalCode($record['postal_code']); 
            $localities->setLocality($record['locality']);            
            $manager->persist($localities);
            $this->addReference($record['locality'], $localities);
        }

        $manager->flush();
    }
}
