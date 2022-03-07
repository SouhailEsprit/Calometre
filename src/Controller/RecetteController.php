<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Form\SearchRecette2Type;
use App\Form\SearchRecette1Type;
use App\Repository\RecetteLikeRepository;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/recette")
 */
class RecetteController extends AbstractController
{
    /**
     * @Route("/", name="recette_index", methods={"GET","POST"})
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

        return $this->render('recette/index.html.twig', [
            'recettes' => $recettes,
            'search_form' => $search_form->createView(),
            'search2_form' => $search2_form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="recette_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('Image')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('recette_images'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $recette->setImage($newFilename);
            }
            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->redirectToRoute('recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recette/new.html.twig', [
            'recette' => $recette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recette_show", methods={"GET"})
     */
    public function show(Recette $recette): Response
    {

        return $this->render('recette/show.html.twig', [
            'recette' => $recette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recette_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Recette $recette, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recette/edit.html.twig', [
            'recette' => $recette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recette_delete", methods={"POST"})
     */
    public function delete(Request $request, Recette $recette, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recette->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recette_index', [], Response::HTTP_SEE_OTHER);
    }
}
