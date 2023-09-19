<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
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

    #[Route('/etudiants/{id_etudiant}', name: 'app_etudiant_info')]
    public function info(EtudiantRepository $etudiantRepository, int $id_etudiant): Response
    {
        $etudiant = $etudiantRepository->find($id_etudiant);
        if ($etudiant == null){
            return $this->redirectToRoute('app_erreur404');
        }

        $interval = $etudiant->getDateNaissance()->diff(now());
        $age = $interval->y;

        return $this->render('etudiant/infoEtudiant.html.twig', [
            "etudiant" => $etudiant,
            "age" => $age
        ]);
    }
}
