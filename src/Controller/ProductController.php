<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartProds;
use App\Entity\Category;
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
use App\Repository\CategoryRepository;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Exception\ExceptionInterface;

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
        $requestString = $request->get('b');
        $product = $em->getRepository(Product::class)->findEntitiesByString($requestString);
        if (!$product) {
            $result['product']['error'] = "Product not found! 🙁 ";
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
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        if (isset($_GET["q"])) {
            return $this->render('product/indextest.html.twig', [
                'products' => $productRepository->findEntitiesByString($_GET["q"]),
                'category'=>$categoryRepository->findAll(),
            ]);
        } else {
            return $this->render('product/indextest.html.twig', [
                'products' => $productRepository->findAll(),
                'category'=>$categoryRepository->findAll(),
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
    public function indexFront(CartRepository $cart, EntityManagerInterface $em,ProductRepository $productRepository): Response
    {


        $user = $this->getUser();
        if($user != null){
        $currentCart = $user->getCart();
        return $this->render('product/indexFrontTest.html.twig', [
            'products' => $productRepository->findAll(),
            'currentCart' => $currentCart
        ]);}
        else{
            return $this->redirectToRoute('app_login');

        }
    }

    /**
     * @Route("/front/products/{id}", name="product_front_show", methods={"GET"})
     */
    public function showFront(CartRepository $cart, EntityManagerInterface $em, Product $product): Response
    {
        $user = $this->getUser();
        $currentCart = $user->getCart();
        return $this->render('product/showFront.html.twig', [
            'product' => $product,
            'currentCart' => $currentCart
        ]);
    }

    /*CODENAME ONE*/

    /**
     * @Route("/mobile/addProduct", name="addProductMobile")
     */
    public function addProdMobile(Request $request)
    {
        $name = $request->query->get('name');
        $description = $request->query->get('description');
        $image = $request->query->get('image');
        $price = $request->query->get('price');
        $quantity = $request->query->get('quantity');
        $catId = $request->query->get('catId');

        $categroy = $this->getDoctrine()->getManager()->getRepository(Category::class)->find($catId);

        $product = new Product();
        $product->setName($name);
        $product->setDescription($description);
        $product->setImage($image);
        $product->setPrice($price);
        $product->setQuantity($quantity);
        $product->setCategory($categroy);

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
     * @Route("/mobile/addCategory", name="addProductCatMobile")
     */
    public function addProdCatMobile(Request $request)
    {
        $name = $request->query->get('name');

        $product = new Category();
        $product->setName($name);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return new JsonResponse("Category added successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e);
        }
    }

    /**
     * @Route("/mobile/deleteProduct", name="deleteProductMobile")
     */
    public function deleteProdMobile(Request $request)
    {
        $id = $request->query->get('id');
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(['id' => $id]);

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
     * @Route("/mobile/deleteCategory", name="deleteCategoryMobile")
     */
    public function deleteCategoryMobile(Request $request)
    {
        $id = $request->query->get('id');
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneBy(['id' => $id]);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
            return new JsonResponse("Category removed successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e->getMessage());
        }
    }

    /**
     * @Route("/mobile/editProduct", name="editProductMobile")
     */
    public function editProductMobile(Request $request)
    {
        $id = $request->query->get('id');
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(['id' => $id]);

        $name = $request->query->get('name');
        $description = $request->query->get('description');
        $image = $request->query->get('image');
        $price = $request->query->get('price');
        $quantity = $request->query->get('quantity');

        $product->setName($name);
        $product->setDescription($description);
        $product->setImage($image);
        $product->setPrice($price);
        $product->setQuantity($quantity);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new JsonResponse("product edited successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e->getMessage());
        }
    }

    /**
     * @Route("/mobile/editCategory", name="editCategoryMobile")
     */
    public function editCategoryMobile(Request $request)
    {
        $id = $request->query->get('id');
        $type = $this->getDoctrine()->getRepository(Category::class)->findOneBy(['id' => $id]);

        $name = $request->query->get('name');

        $type->setName($name);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new JsonResponse("type edited successfully");
        } catch (\Exception $e) {
            return new JsonResponse("error on " . $e->getMessage());
        }
    }

    /**
     * @Route("/mobile/showProduct", name="showProductMobile")
     */
    public function showProductMobile(ProductRepository $rep): Response
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

    /**
     * @Route("/mobile/showCategory", name="showCategoryMobile")
     */
    public function showCategoryMobile(CategoryRepository $rep): Response
    {
        $category = $rep->findAll();

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($category, 'json', ['circular_reference_handler' => function ($object) {
            return $object->getId();
        }
        ]);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}