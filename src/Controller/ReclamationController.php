<?php

namespace App\Controller;

use App\Entity\Historique;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
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
    public function new(Request $request, EntityManagerInterface $entityManager, TranslatorInterface $translator): Response
    {
        $user = $this->getUser();
        if ($user != null) {
            $curentCart = 1;
            $reclamation = new Reclamation();
            $form = $this->createForm(ReclamationType::class, $reclamation);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $reclamation->setDate(new \DateTime);
                $entityManager->persist($reclamation);
                $entityManager->flush();
                $message = $translator->trans('ajouter avec succe');
                $this->addFlash('message', $message);


                $entityManager->flush();
                return $this->redirectToRoute('reclamation_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('reclamation/new.html.twig', [
                'reclamation' => $reclamation,
                'form' => $form->createView(),
                'currentCart' => $curentCart
            ]);
        } else {
            return $this->redirectToRoute('app_login');

        }
    }

    /**
     * @Route("/{id}", name="reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $value = $reclamation->getViews();
        $value = $value + 1;
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
        if ($this->isCsrfTokenValid('delete' . $reclamation->getId(), $request->request->get('_token'))) {
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

    /*CODENAME ONE*/

    /**
     * @Route("/mobile/addReclamation", name="addReclamationMobile")
     */
    public function addReclamationMobile(Request $request)
    {
        $type = $request->query->get('type');
        $email = $request->query->get('email');
        $message = $request->query->get('message');


        $reclamation = new Reclamation();
        $reclamation->setType($type);
        $reclamation->setEmail($email);
        $reclamation->setMessage($message);


        $reclamation->setDate(new \DateTimeImmutable());

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return new JsonResponse("reclamation added successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e);
        }
    }

    /**
     * @Route("/mobile/deleteReclamation", name="deleteReclamationMobile")
     */
    public function deleteReclamationMobile(Request $request)
    {
        $id = $request->query->get('id');
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->findOneBy(['id' => $id]);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reclamation);
            $em->flush();
            return new JsonResponse("reclamation removed successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e->getMessage());
        }
    }

    /**
     * @Route("/mobile/editReclamation", name="editReclamationMobile")
     */
    public function editReclamationMobile(Request $request)
    {
        $id = $request->query->get('id');
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->findOneBy(['id' => $id]);

        $message = $request->query->get('message');


        $reclamation->setMessage($message);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new JsonResponse("reclamation edited successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e->getMessage());
        }
    }

    /**
     * @Route("/mobile/showReclamation", name="showReclamationMobile")
     */
    public function showProductMobile(ReclamationRepository $rep): Response
    {
        $reclamations = $rep->findAll();

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($reclamations, 'json', ['circular_reference_handler' => function ($object) {
            return $object->getId();
        }
        ]);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}