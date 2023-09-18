<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use function Symfony\Component\Clock\now;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       for($i = 0; $i<10; $i++){
           $etudiant = new Etudiant();
           $etudiant->setPrenom("prenom$i");
           $manager->persist($etudiant);
       }

        $manager->flush();
    }
}
