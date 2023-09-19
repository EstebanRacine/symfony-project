<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Erreur404Controller extends AbstractController
{
    #[Route('/erreur404', name: 'app_erreur404')]
    public function erreur404(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
    }
}
