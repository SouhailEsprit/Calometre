<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\ReponseType;
use App\Repository\ReponseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reponse")
 */
class ReponseController extends AbstractController
{
    /**
     * @Route("/", name="reponse_index", methods={"GET"})
     */
    public function index(ReponseRepository $reponseRepository): Response
    {
        return $this->render('reponse/index.html.twig', [
            'reponses' => $reponseRepository->getAllAnswers(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="reponse_new", methods={"GET", "POST"})
     */
    public function new(Request $request, Reclamation $rec, EntityManagerInterface $entityManager, \Swift_Mailer $mailer): Response
    {
        $reponse = new Reponse();
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponse->setRepondre($rec);
            $reponse->setDate(new \DateTime);
            $entityManager->persist($reponse);
            $entityManager->flush();

            $answer = $reponse->getReponse();

            $message = (new \Swift_Message('Reponse sur Votre réclamation'))
                ->setFrom('calometre@gmail.com')
                ->setTo($rec->getEmail())
                ->setBody(
                    $this->render('emails/reponse.html.twig',['answer' => $answer]),
                    'text/html'
                );
            $mailer->send($message);

            return $this->redirectToRoute('reponse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reponse/new.html.twig', [
            'reponse' => $reponse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reponse_show", methods={"GET"})
     */
    public function show(Reponse $reponse): Response
    {
        return $this->render('reponse/show.html.twig', [
            'reponse' => $reponse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reponse_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reponse $reponse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponse->setDate(new \DateTime);
            $entityManager->flush();

            return $this->redirectToRoute('reponse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reponse/edit.html.twig', [
            'reponse' => $reponse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reponse_delete", methods={"POST"})
     */
    public function delete(Request $request, Reponse $reponse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reponse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reponse_index', [], Response::HTTP_SEE_OTHER);
    }
}
