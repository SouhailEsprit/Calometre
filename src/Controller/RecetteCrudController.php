<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\Recette1Type;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recette/crud")
 */
class RecetteCrudController extends AbstractController
{
    /**
     * @Route("/", name="recette_crud_index", methods={"GET"})
     */
    public function index(RecetteRepository $recetteRepository): Response
    {
        return $this->render('recette_crud/index.html.twig', [
            'recettes' => $recetteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="recette_crud_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recette = new Recette();
        $form = $this->createForm(Recette1Type::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->redirectToRoute('recette_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recette_crud/new.html.twig', [
            'recette' => $recette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recette_crud_show", methods={"GET"})
     */
    public function show(Recette $recette): Response
    {
        return $this->render('recette_crud/show.html.twig', [
            'recette' => $recette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recette_crud_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Recette $recette, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Recette1Type::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('recette_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recette_crud/edit.html.twig', [
            'recette' => $recette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recette_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Recette $recette, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recette->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recette_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
