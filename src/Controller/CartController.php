<?php

namespace App\Controller;
use App\Entity\CartProds;
use App\Entity\Cart;
use App\Entity\Product;
use App\Repository\CartRepository;
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
    {
        $cartprod = new CartProds();      
        $usercartid = $em->getRepository(cart::class)->find('1');
        $idprod =(int)$request->get("b");
        $prod = $em->getRepository(Product::class)->find($idprod);
             
    //   $idprod = $this-> getParameter('clicked_id');
    $qty=5;
        $cartprod->setQty($qty);
      $cartprod->setIdcart($usercartid);
      $cartprod->setIdprod($prod);

      $em->persist($cartprod);
         $em->flush();
        
         return $this->render('product/indexFrontTest.html.twig', [
            'products' => $productRepository->findAll(),

        ]);
        
        }
    
        
        /**
     * @Route("/cart/{id}", name="product_front_cart", methods={"GET", "POST"})
     */
    public function showFrontCart(CartRepository $cart,$id): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->find($id),
        ]);
    }
//      /**
//      * @Route("/cart/{id}", name="carttest", methods={"GET" , "post"})
//      */
//     public function test1212($id,CartRepository $cart, ProductRepository $productRepository): Response
//     {   
//         return $this->redirectToRoute('product_front_index', [], Response::HTTP_SEE_OTHER);


//     return $this->render('cart/index.html.twig', [
//         'cart' => $cart->find($id),
//     ]);
// }
}
