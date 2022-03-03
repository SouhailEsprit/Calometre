<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlimFrontController extends AbstractController
{
    /**
     * @Route("/alim/front", name="app_alim_front")
     */
    public function index(AlimentRepository  $alimentRepository): Response
    {
        return $this->render('alim_front/index.html.twig', [
            'aliments' => $alimentRepository->findAll(),
        ]);
    }

}
