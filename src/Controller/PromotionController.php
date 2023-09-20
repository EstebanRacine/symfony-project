<?php

namespace App\Controller;

use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    #[Route('/promotions', name: 'app_promotions')]
    public function list(PromotionRepository $promotionRepository): Response
    {
        $promotions = $promotionRepository->findAll();
        return $this->render('promotion/index.html.twig', [
            'promotions' => $promotions
        ]);
    }

    #[Route('/promotions/{id}', name: 'app_promotions_info', requirements: ['id'=>'\d+'] )]
    public function info(PromotionRepository $promotionRepository, int $id): Response
    {
        $promotion = $promotionRepository->find($id);
        return $this->render('promotion/infoPromotion.html.twig', [
            'promotion' => $promotion
        ]);
    }
}
