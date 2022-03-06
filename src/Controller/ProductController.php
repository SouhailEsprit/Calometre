<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartProds;
use App\Entity\Images;
use App\Entity\Product;
use App\Form\Product1Type;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CartRepository;




/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/recherche_product", name="ajaxsearch")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $product = $em->getRepository(Product::class)->findEntitiesByString($requestString);
        if (!$product) {
            $result['product']['error'] = "product introuvable :( ";
        } else {
            $result['product'] = $this->getRealEntities($product);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($product)
    {
        foreach ($product as $product) {
            $realEntities[$product->getId()] = [$product->getName(), $product->getPrice(), $product->getDescription(), $product->getCategory(), $product->getQuantity(), $product->getImage()];
        }
        return $realEntities;
    }


    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        if (isset($_GET["q"])) {
            return $this->render('product/indextest.html.twig', [
                'products' => $productRepository->findEntitiesByString($_GET["q"]),
            ]);
        } else {
            return $this->render('product/indextest.html.twig', [
                'products' => $productRepository->findAll(),
            ]);
        }
    }

    /**
     * @Route("/new", name="product_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(Product1Type::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('images')->getData();


            foreach ($images as $image) {

                $fichier = md5(uniqid()) . '.' . $image->guessExtension();


                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );


                $product->setImage($fichier);
            }

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Product1Type::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $images = $form->get('images')->getData();


            foreach ($images as $image) {

                $fichier = md5(uniqid()) . '.' . $image->guessExtension();


                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );


                $product->setImage($fichier);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="product_delete", methods={"POST"})
     */
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    }

   
    /**
     * @Route("/front/products", name="product_front_index", methods={"GET"})
     */
    public function indexFront(EntityManagerInterface $em,ProductRepository $productRepository): Response
    {   
        $cart = $em->getRepository(cart::class)->find('1');
        return $this->render('product/indexFrontTest.html.twig', [
            'products' => $productRepository->findAll(),
            'cart' => $cart
        ]);
    }
     
    /**
     * @Route("/front/products/{id}", name="product_front_show", methods={"GET"})
     */
    public function showFront(Product $product): Response
    {
        return $this->render('product/showFront.html.twig', [
            'product' => $product,
        ]);
    }
    
}