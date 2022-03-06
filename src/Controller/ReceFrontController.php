<?php

namespace App\Controller;
use App\Form\SearchRecette1Type;
use App\Form\SearchRecette2Type;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReceFrontController extends AbstractController
{
    /**
     * @Route("/rece/front", name="app_rece_front")
     */

    public function index(Request $request, RecetteRepository $recetteRepository): Response
    {
        $data = $request->request->get('search_recette2');
        $data1 = $request->request->get('search_recette1');
        if($data && $data['query']) {
            $recettes = $recetteRepository->createQueryBuilder('a')
                ->where('a.Name LIKE :term')
                ->setParameter('term', '%' . $data['query'] . '%')

                ->getQuery()
                ->getResult();
        }
        else if ($data1 && $data1['query'])
        {
            $recettes = $recetteRepository->createQueryBuilder('a')
                ->where('a.categorie = :term')
                ->setParameter('term',$data1['query'])

                ->getQuery()
                ->getResult();
        }
        else{
            $recettes = $recetteRepository->findBy(array());
        }

        $search_form = $this->createForm(SearchRecette1Type::class);
        $search2_form = $this->createForm(SearchRecette2Type::class);

        return $this->render('rece_front/index.html.twig', [
            'recettes' => $recettes,
            'search_form' => $search_form->createView(),
            'search2_form' => $search2_form->createView(),
        ]);
    }

}
