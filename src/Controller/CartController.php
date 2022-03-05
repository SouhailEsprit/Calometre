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
        $usercartid = $em->getRepository(cart::class)->find('1');
        $idprod =$request->get("b");
        $prod = $em->getRepository(Product::class)->find($idprod);
       
      
    
    
        $cartprod->setQty(1);
      $cartprod->setIdcart($usercartid);
      $cartprod->setIdprod($prod);

      $em->persist($cartprod);
         $em->flush();
         return $this->redirectToRoute('product_front_index', [], Response::HTTP_SEE_OTHER);
      
         return $this->render('product/indexFrontTest.html.twig', [
            'products' => $productRepository->findAll(),
            'cart' => $cart
        ]);
        
        }
        
    
        
        /**
     * @Route("/cart/{id}", name="product_front_cart", methods={"GET", "POST"})
     */
    public function showFrontCart(  request $request,ProductRepository $productRepository, CartProdsRepository $CartProdsRepository ,CartRepository $cart,$id): Response
    {
        $qty= new Cartprods(); 
        $form = $this->createForm(CartProdsType::class, $qty);
        $form->handleRequest($request);
        return $this->render('cart_prods/index.html.twig', [
            'product'=>$productRepository->findAll(),
            'cart' => $cart->find($id),
            'cartprod' =>$CartProdsRepository->findAll(),
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}/edit/test", name="edit_qty", methods={"GET", "POST"})
     */
    public function editCart( Request $request, CartProds $cartProd,ProductRepository $productRepository , CartProdsRepository $CartProdsRepository ,EntityManagerInterface $entityManager): Response
    {   $cart = $entityManager->getRepository(cart::class)->find('1');
        $form = $this->createForm(CartProdsType::class, $cartProd);
        $form->handleRequest($request);
        $id = $cart->getId();

        if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();
            return $this->redirectToRoute('product_front_cart', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cart_prods/EditCart.html.twig', [
            'product'=>$productRepository->findAll(),
            'cartprod' =>$CartProdsRepository->findAll(),
            'pp' => $cartProd,
            'form' => $form->createView(),
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
