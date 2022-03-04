<?php

namespace App\Controller;

use App\Form\SeachAliment2Type;
use App\Form\SeachAlimentType;
use App\Repository\AlimentRepository;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlimFrontController extends AbstractController
{
    /**
     * @Route("/alim/front", name="app_alim_front")
     */

    public function index(Request $request, AlimentRepository $alimentRepository): Response
    {
        $data = $request->request->get('seach_aliment');
        $data1 = $request->request->get('seach_aliment2');
        if($data && $data['query']) {
            $aliments = $alimentRepository->createQueryBuilder('a')
                ->where('a.name LIKE :term')
                ->setParameter('term', '%' . $data['query'] . '%')
                ->orderBy('a.calories', 'ASC')
                ->getQuery()
                ->getResult();
        }
        else if ($data1 && $data1['query'])
        {$aliments = $alimentRepository->createQueryBuilder('a')
            ->where('a.categorie = :term')
            ->setParameter('term',$data1['query'])
            ->orderBy('a.calories', 'ASC')
            ->getQuery()
            ->getResult();
        }
        else{
            $aliments = $alimentRepository->findBy(array(),array('calories' => 'ASC'));
        }

        $search_form = $this->createForm(SeachAlimentType::class);
        $search2_form = $this->createForm(SeachAliment2Type::class);

        return $this->render('alim_front/index.html.twig', [
            'aliments' => $aliments,
            'search_form' => $search_form->createView(),
            'search2_form' => $search2_form->createView(),
        ]);
    }

}
