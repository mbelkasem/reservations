<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Roles;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $roles = [
            ['role'=>'admin'],
            ['role'=>'member'],
            ['role'=>'affiliate'],
        ];

        foreach ($roles as $record) {
            $role = new Roles();
            $role->setRole($record['role']);            
            $manager->persist($role);
        }


        $manager->flush();
    }
}
