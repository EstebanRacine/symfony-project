<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Clock\now;

class EtudiantController extends AbstractController
{
    #[Route('/etudiants', name: 'app_etudiant_list')]
    public function list(EtudiantRepository $etudiantRepository): Response
    {
        //Appel du modèle qui liste les étudiants
        $etudiants = $etudiantRepository->findAll();
        return $this->render('etudiant/index.html.twig', [
            "etudiants" => $etudiants
        ]);
    }

    #[Route('/etudiants/mineursCriteres', name: 'app_etudiant_mineurs_list_critere')]
    public function listMineursCritere(EtudiantRepository $etudiantRepository): Response
    {
        $dateMajorite = new \DateTime('-18 years');
        $critere = new Criteria();
        $critere->where(Criteria::expr()->gte("dateNaissance", $dateMajorite));
        $etudiants = $etudiantRepository->matching($critere);
        return $this->render('etudiant/index.html.twig', [
            "etudiants" => $etudiants
        ]);
    }

    #[Route('/etudiants/mineurs', name: 'app_etudiant_mineurs_list')]
    public function listMineurs(EtudiantRepository $etudiantRepository): Response
    {
        $etudiants = $etudiantRepository->findMineurs2();
        return $this->render('etudiant/index.html.twig', [
            "etudiants" => $etudiants
        ]);
    }

    #[Route('/etudiants/{id_etudiant}', name: 'app_etudiant_info', requirements: ['id'=>'\d+'])]
    public function info(EtudiantRepository $etudiantRepository, int $id_etudiant): Response
    {
        $etudiant = $etudiantRepository->find($id_etudiant);
        if ($etudiant == null){
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
        }
        return $this->render('etudiant/infoEtudiant.html.twig', [
            "etudiant" => $etudiant
        ]);
    }


}
