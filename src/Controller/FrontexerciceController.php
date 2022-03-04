<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontexerciceController extends AbstractController
{
    /**
     * @Route("/frontexercice", name="frontexercice")
     */
    public function index(): Response
    {
        
        return $this->render('frontexercice/index.html.twig', [
            'controller_name' => 'FrontexerciceController',
        ]);
    }
}
