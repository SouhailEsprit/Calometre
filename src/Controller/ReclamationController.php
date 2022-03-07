<?php

namespace App\Controller;

use App\Entity\Historique;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/reclamation")
 */
class ReclamationController extends AbstractController
{
    /**
     * @Route("/", name="reclamation_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->findAll();
        $reclamation = $paginator->paginate($reclamation,
            $request->query->getInt('page', 1),
            5);
        return $this->render('reclamation/index.html.twig', [
            'reclamation' => $reclamation

        ]);
    }



    /**
     * @Route ("/change-locales/{locale}",name="change_locale")
     */

    public function changeLocale($locale, Request $request)

    {

        $request->getSession()->set('_locale', $locale);
        return $this->redirect($request->headers->get('referer'));
    }



    /**
     * @Route("/new", name="reclamation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager ,TranslatorInterface $translator): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setDate(new \DateTime);
            $entityManager->persist($reclamation);
            $entityManager->flush();
            $message=$translator->trans('ajouter avec succe');
            $this->addFlash('message',$message);


            $entityManager->flush();
            return $this->redirectToRoute('reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $value = $reclamation->getViews();
        $value = $value + 1 ;
        $reclamation->setViews($value);
        $entityManager->flush();
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reclamation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setDate(new \DateTime);
            $entityManager->flush();
            $historique = new Historique();
            $historique->setAction("Edit reclamation");
            $historique->setModel("Reclamation");
            $historique->setDate(new \DateTime());
            $entityManager->persist($historique);
            $entityManager->flush();
            return $this->redirectToRoute('reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reclamation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
            $historique = new Historique();
            $historique->setAction("Delete reclamation");
            $historique->setModel("Reclamation");
            $historique->setDate(new \DateTime());
            $entityManager->persist($historique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reclamation_index', [], Response::HTTP_SEE_OTHER);
    }
}