<?php

namespace App\Controller;

use App\Entity\Reclamer;
use App\Form\ReclamerType;
use App\Repository\ReclamerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reclamer")
 */
class ReclamerController extends AbstractController
{
    /**
     * @Route("/", name="reclamer_index", methods={"GET"})
     */
    public function index(ReclamerRepository $reclamerRepository): Response
    {
        return $this->render('reclamer/index.html.twig', [
            'reclamers' => $reclamerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reclamer_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamer = new Reclamer();
        $form = $this->createForm(ReclamerType::class, $reclamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reclamer);
            $entityManager->flush();

            return $this->redirectToRoute('reclamer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamer/new.html.twig', [
            'reclamer' => $reclamer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reclamer_show", methods={"GET"})
     */
    public function show(Reclamer $reclamer): Response
    {
        return $this->render('reclamer/show.html.twig', [
            'reclamer' => $reclamer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reclamer_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reclamer $reclamer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamerType::class, $reclamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('reclamer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamer/edit.html.twig', [
            'reclamer' => $reclamer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reclamer_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamer $reclamer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reclamer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reclamer_index', [], Response::HTTP_SEE_OTHER);
    }
}
