<?php

namespace App\DataFixtures;

use App\Entity\MaritalStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InitFixtures extends Fixture {
    const FIXTUREDATA = [
        'App\Entity\Gender' => [
            ['setName' => 'Male'],
            ['setName' => 'Female'],
            ['setName' => 'Prefer not to say'],
            ['setName' => 'Other'],
        ],
        'App\Entity\MaritalStatus' => [
            ['setName' => 'Single'],
            ['setName' => 'Married'],
            ['setName' => 'Prefer not to say'],
            ['setName' => 'Other'],
        ],
    ];

    public function load(ObjectManager $manager): void {
        foreach (self::FIXTUREDATA as  $class => $fixture) {
            foreach ($fixture as  $data) {

                foreach ($data as $attribute => $value) {
                    $object = new $class;
                    $object->$attribute($value);
                    $manager->persist($object);
                }
            }
        }



        $manager->flush();
    }
}
