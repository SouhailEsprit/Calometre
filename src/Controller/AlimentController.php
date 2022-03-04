<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Form\SeachAliment2Type;
use App\Form\SeachAlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aliment")
 */
class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="aliment_index", methods={"GET", "POST"})
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

        return $this->render('aliment/index.html.twig', [
            'aliments' => $aliments,
            'search_form' => $search_form->createView(),
            'search2_form' => $search2_form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="aliment_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $aliment = new Aliment();
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('Image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('aliment_images'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $aliment->setImage($newFilename);
            }
            $entityManager->persist($aliment);
            $entityManager->flush();

            return $this->redirectToRoute('aliment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aliment/new.html.twig', [
            'aliment' => $aliment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aliment_show", methods={"GET"})
     */
    public function show(Aliment $aliment): Response
    {
        return $this->render('aliment/show.html.twig', [
            'aliment' => $aliment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="aliment_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Aliment $aliment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('aliment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aliment/edit.html.twig', [
            'aliment' => $aliment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aliment_delete", methods={"POST"})
     */
    public function delete(Request $request, Aliment $aliment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aliment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($aliment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('aliment_index', [], Response::HTTP_SEE_OTHER);
    }
}
