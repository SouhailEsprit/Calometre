<?php

namespace App\Controller;

use App\Entity\Typeexercice;
use App\Form\TypeexerciceType;
use App\Repository\TypeexerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/typeexercice")
 */
class TypeexerciceController extends AbstractController
{
    /**
     * @Route("/", name="typeexercice_index", methods={"GET"})
     */
    public function index(TypeexerciceRepository $typeexerciceRepository): Response
    {
        return $this->render('typeexercice/index.html.twig', [
            'typeexercices' => $typeexerciceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="typeexercice_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeexercice = new Typeexercice();
        $form = $this->createForm(TypeexerciceType::class, $typeexercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeexercice);
            $entityManager->flush();

            return $this->redirectToRoute('typeexercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('typeexercice/new.html.twig', [
            'typeexercice' => $typeexercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="typeexercice_show", methods={"GET"})
     */
    public function show(Typeexercice $typeexercice): Response
    {
        return $this->render('typeexercice/show.html.twig', [
            'typeexercice' => $typeexercice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="typeexercice_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Typeexercice $typeexercice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeexerciceType::class, $typeexercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('typeexercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('typeexercice/edit.html.twig', [
            'typeexercice' => $typeexercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="typeexercice_delete", methods={"POST"})
     */
    public function delete(Request $request, Typeexercice $typeexercice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeexercice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeexercice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('typeexercice_index', [], Response::HTTP_SEE_OTHER);
    }
}
