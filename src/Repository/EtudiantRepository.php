<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etudiant>
 *
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }
    //Methode pour rechercher les elèves mineurs

    /*
     * Etudiant[]
     */
    public function findMineurs():array{
        //Langage DQL -> SQL by Doctrine à execution
        $dateMajorite = new \DateTime('-18 years');
        //Reference aux classes et non aux tables
        //Exprime ma requete
        $requeteDQL = "SELECT e FROM App\Entity\Etudiant as e WHERE e.dateNaissance >= :dateMajorite";
        //Construit la requete
        $requete = $this->getEntityManager()->createQuery($requeteDQL);
        //Donner une valeur au parametre
        $requete->setParameter('dateMajorite',$dateMajorite);
        //Executer la requete
        return $requete->getResult();
    }

    public function findMineurs2():array{
        //Utiliser le query builder -> construire dynamiquement requete DQL
        $dateMajorite = new \DateTime('-18 years');
        return $this->createQueryBuilder('e')
            ->where("e.dateNaissance > :dateMajorite")
            ->setParameter('dateMajorite', $dateMajorite)
            ->getQuery()
            ->getResult();
    }


//    /**
//     * @return Etudiant[] Returns an array of Etudiant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Etudiant
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
