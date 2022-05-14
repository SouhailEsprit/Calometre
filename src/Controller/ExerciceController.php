<?php

namespace App\Controller;

use App\Entity\Typeexercice;
use App\Repository\CategoryRepository;
use App\Repository\TypeexerciceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/exercice")
 */
class ExerciceController extends AbstractController
{
    /**
     * @Route("/", name="exercice_index", methods={"GET"})
     */
    public function index(ExerciceRepository $exerciceRepository): Response
    {
        if (isset($_GET["q"])) {
            return $this->render('exercice/index.html.twig', [
                'exercices' => $exerciceRepository->findEntitiesByString($_GET["q"]),
            ]);
        } else {
            return $this->render('exercice/index.html.twig', [
                'exercices' => $exerciceRepository->findAll(),
            ]);
        }
    }

    /**
     * @Route("/list", name="exercice_front")
     */

    public function error(ExerciceRepository $ex, Request $request, PaginatorInterface $paginator): Response
    {

        $donnees = $this->getDoctrine()->getRepository(Exercice::class)->findAll();

        $exercices = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );

        return $this->render('exercice/indexfront.html.twig', [
            'exercices' => $exercices,

        ]);
    }


    /**
     * @Route("/new", name="exercice_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exercice = new Exercice();
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $video = $form->get('video')->getData();


            foreach ($video as $videos) {
                $fichier = md5(uniqid()) . '.' . $videos->guessExtension();


                $videos->move(
                    $this->getParameter('video_directory'),
                    $fichier
                );

                $exercice->setVideo($fichier);

            }
            $entityManager->persist($exercice);
            $entityManager->flush();

            return $this->redirectToRoute('exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exercice/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Exercice $exercice): Response
    {
        return $this->render('exercice/show.html.twig', [
            'exercice' => $exercice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="exercice_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Exercice $exercice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exercice/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exercice_delete", methods={"POST"})
     */
    public function delete(Request $request, Exercice $exercice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $exercice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($exercice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('exercice_index', [], Response::HTTP_SEE_OTHER);
    }

    /*CODENAME ONE*/

    /**
     * @Route("/mobile/addType", name="addTypeExcMobile")
     */
    public function addTypeExcMobile(Request $request)
    {
        $name = $request->query->get('name');

        $type = new Typeexercice();
        $type->setNom($name);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();
            return new JsonResponse("Type Exercice added successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e);
        }
    }

    /**
     * @Route("/mobile/deleteType", name="deleteTypeExcMobile")
     */
    public function deleteTypeExcMobile(Request $request)
    {
        $id = $request->query->get('id');
        $category = $this->getDoctrine()->getRepository(Typeexercice::class)->findOneBy(['id' => $id]);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
            return new JsonResponse("Type exercice removed successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e->getMessage());
        }
    }

    /**
     * @Route("/mobile/editType", name="editTypeExcMobile")
     */
    public function editTypeExcMobile(Request $request)
    {
        $id = $request->query->get('id');
        $type = $this->getDoctrine()->getRepository(Typeexercice::class)->findOneBy(['id' => $id]);

        $name = $request->query->get('name');

        $type->setNom($name);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new JsonResponse("type edited successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e->getMessage());
        }
    }

    /**
     * @Route("/mobile/showType", name="showTypeExcMobile")
     */
    public function showTypeExcMobile(TypeexerciceRepository $rep): Response
    {
        $type = $rep->findAll();

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($type, 'json', ['circular_reference_handler' => function ($object) {
            return $object->getId();
        }
        ]);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
/*************************/

    /**
     * @Route("/mobile/addExercice", name="addExerciceMobile")
     */
    public function addProdMobile(Request $request)
    {
        $name = $request->query->get('name');
        $description = $request->query->get('description');
        $objectif = $request->query->get('objectif');
        $video = $request->query->get('video');
        $typeId = $request->query->get('typeId');

        $type = $this->getDoctrine()->getManager()->getRepository(Typeexercice::class)->find($typeId);

        $product = new Exercice();
        $product->setNom($name);
        $product->setDescription($description);
        $product->setObjectif($objectif);
        $product->setVideo($video);
        $product->setNomtype($type);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return new JsonResponse("Product added successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e);
        }
    }

    /**
     * @Route("/mobile/deleteExercice", name="deleteExerciceMobile")
     */
    public function deleteProdMobile(Request $request)
    {
        $id = $request->query->get('id');
        $product = $this->getDoctrine()->getRepository(Exercice::class)->findOneBy(['id' => $id]);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
            return new JsonResponse("product removed successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e->getMessage());
        }
    }

    /**
     * @Route("/mobile/editExercice", name="editExerciceMobile")
     */
    public function editProductMobile(Request $request)
    {
        $id = $request->query->get('id');
        $product = $this->getDoctrine()->getRepository(Exercice::class)->findOneBy(['id' => $id]);

        $name = $request->query->get('name');
        $description = $request->query->get('description');
        $objectif = $request->query->get('objectif');
        $video = $request->query->get('video');

        $product->setNom($name);
        $product->setDescription($description);
        $product->setObjectif($objectif);
        $product->setVideo($video);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new JsonResponse("product edited successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e->getMessage());
        }
    }

    /**
     * @Route("/mobile/showExercice", name="showExerciceMobile")
     */
    public function showProductMobile(ExerciceRepository $rep): Response
    {
        $products = $rep->findAll();

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($products, 'json', ['circular_reference_handler' => function ($object) {
            return $object->getId();
        }
        ]);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


}
