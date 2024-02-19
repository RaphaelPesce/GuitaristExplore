<?php

namespace App\Controller;

use App\Repository\GuitaristRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuitaristController extends AbstractController
{
    #[Route('/guitarist', name: 'app_guitarist')]
    public function index(GuitaristRepository $guitaristRepository): Response
    {
        return $this->render('guitarist/index.html.twig', [
            'guitarist' => $guitaristRepository->findBy([], ['name' => 'ASC'])
        ]);
    }

    #[Route('/classement', name: 'app_ranking')]
    public function ranking(GuitaristRepository $guitaristRepository): Response
    {
        return $this->render('guitarist/ranking.html.twig', [
            'guitarist' => $guitaristRepository->findTopRatedGuitarists()
        ]);
    }
}
