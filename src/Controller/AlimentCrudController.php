<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Form\Aliment1Type;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aliment/crud")
 */
class AlimentCrudController extends AbstractController
{
    /**
     * @Route("/", name="aliment_crud_index", methods={"GET"})
     */
    public function index(AlimentRepository $alimentRepository): Response
    {
        return $this->render('aliment_crud/index.html.twig', [
            'aliments' => $alimentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="aliment_crud_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $aliment = new Aliment();
        $form = $this->createForm(Aliment1Type::class, $aliment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($aliment);
            $entityManager->flush();

            return $this->redirectToRoute('aliment_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aliment_crud/new.html.twig', [
            'aliment' => $aliment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aliment_crud_show", methods={"GET"})
     */
    public function show(Aliment $aliment): Response
    {
        return $this->render('aliment_crud/show.html.twig', [
            'aliment' => $aliment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="aliment_crud_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Aliment $aliment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Aliment1Type::class, $aliment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('aliment_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aliment_crud/edit.html.twig', [
            'aliment' => $aliment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aliment_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Aliment $aliment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aliment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($aliment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('aliment_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
