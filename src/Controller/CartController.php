<?php

namespace App\Controller;
use App\Entity\CartProds;
use App\Entity\Cart;
use App\Entity\Product;
use App\Form\CartProdsType;
use App\Repository\CartRepository;
use App\Repository\CartProdsRepository;
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/product/front/products")
 */

class CartController extends AbstractController
{

    /**
     * @Route("/add", name="addcart", methods={"GET", "POST"})
     */
    public function AddToProdCart(Request $request, EntityManagerInterface $em, ProductRepository $productRepository ): Response
    {   $cart = new Cart();
        $cartprod = new CartProds();
        $user = $this->getUser();
        $currentCart = $user->getCart();;
        $idprod =$request->get("b");
        $prod = $em->getRepository(Product::class)->find($idprod);




        $cartprod->setQty(1);
        $cartprod->setIdcart($currentCart);
        $cartprod->setIdprod($prod);

        $em->persist($cartprod);
        $em->flush();
        return $this->redirectToRoute('product_front_index', [], Response::HTTP_SEE_OTHER);

        return $this->render('product/indexFrontTest.html.twig', [
            'products' => $productRepository->findAll(),
            'currentCart' => $currentCart
        ]);

    }



    /**
     * @Route("/cart/{id}", name="product_front_cart", methods={"GET", "POST"})
     */
    public function showFrontCart(  request $request,ProductRepository $productRepository, CartProdsRepository $CartProdsRepository ,CartRepository $cart,$id): Response
    {
        $user = $this->getUser();
        $currentCart = $user->getCart();
        $qty= new Cartprods();
        $form = $this->createForm(CartProdsType::class, $qty);
        $form->handleRequest($request);
        return $this->render('cart_prods/index.html.twig', [
            'product'=>$productRepository->findAll(),
            'currentCart' => $currentCart,
            'cartprod' =>$CartProdsRepository->findAll(),
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}/edit/", name="edit_qty", methods={"GET", "POST"})
     */
    public function editCart( Request $request, CartProds $cartprod,ProductRepository $productRepository , CartProdsRepository $CartProdsRepository ,EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CartProdsType::class, $cartprod);
        $form->handleRequest($request);
        // id user cart
        $cart = $entityManager->getRepository(cart::class)->find('1');
        $id = $cart->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('product_front_cart', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cart_prods/EditCart.html.twig', [
            'product'=>$productRepository->findAll(),
            'cartprod' =>$CartProdsRepository->findAll(),
            'pp' => $cartprod,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/delete", name="product_delete_cart", methods={"POST"})
     */
    public function delete(Request $request, CartProds $cartprod, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();
        $currentCart = $user->getCart();
        if ($this->isCsrfTokenValid('delete' . $cartprod->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cartprod);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_front_cart', ['id' => $currentCart], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/addtotal", name="addtotal", methods={"GET", "POST"})
     */
    public function total(): Response
    {



        return $this->redirectToRoute('product_front_index', [], Response::HTTP_SEE_OTHER);

        return $this->render('product/indexFrontTest.html.twig', [
            'products' => $productRepository->findAll(),
            'currentCart' => $currentCart
        ]);

    }

    // /**
    //  * @Route("/edit/{id}", name="test_test", methods={"GET", "POST"})
    //  */
    // public function Edit(Cartprods $qty, EntityManagerInterface $entityManager, Request $request): Response
    // {

    //     $form = $this->createForm(CartProdsType::class, $qty);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $entityManager->flush();

    //     return $this->redirectToRoute('product_front_cart', [], Response::HTTP_SEE_OTHER);
    // }
    //     return $this->render('cart_prods/index.html.twig', [
    //         'qty'=>$qty,
    //         'form' => $form->createView(),
    //     ]);
    // }


}
