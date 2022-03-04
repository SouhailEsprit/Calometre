<?php

namespace App\Controller;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReceFrontController extends AbstractController
{
    /**
     * @Route("/rece/front", name="app_rece_front")
     */
    public function index(RecetteRepository  $recetteRepository): Response
    {
        return $this->render('rece_front/index.html.twig', [
            'recettes' => $recetteRepository->findAll(),
        ]);
    }

}
