<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use function Symfony\Component\Clock\now;

class EtudiantFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
       for($i = 1; $i<=100; $i++){
           $faker = Factory::create("fr_FR");
           $etudiant = new Etudiant();
           $etudiant->setPrenom($faker->firstName());
           $etudiant->setNom($faker->lastName());
           $etudiant->setEmail($faker->email());
           $etudiant->setDateNaissance($faker->dateTimeBetween('-30 years', '-17 years'));
           $etudiant->setPromotion($this->getReference('promotion_'.$faker->numberBetween(1, 10)));
           $manager->persist($etudiant);
       }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PromotionFixtures::class
        ];
    }
}
