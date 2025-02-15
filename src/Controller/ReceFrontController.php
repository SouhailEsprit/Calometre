<?php

namespace App\Controller;
use App\Entity\Recette;
use App\Entity\RecetteLike;
use App\Form\SearchRecette1Type;
use App\Form\SearchRecette2Type;
use App\Repository\RecetteLikeRepository;
use App\Repository\RecetteRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ReceFrontController extends AbstractController
{
    /**
     * @Route("/rece/front", name="app_rece_front")
     */

    public function index(Request $request, RecetteRepository $recetteRepository): Response
    {
        $user = $this->getUser();
        $currentCart = $user->getCart();

        $data = $request->request->get('search_recette2');
        $data1 = $request->request->get('search_recette1');
        if($data && $data['query']) {
            $recettes = $recetteRepository->createQueryBuilder('a')
                ->where('a.Name LIKE :term')
                ->setParameter('term', '%' . $data['query'] . '%')

                ->getQuery()
                ->getResult();
        }
        else if ($data1 && $data1['query'])
        {
            $recettes = $recetteRepository->createQueryBuilder('a')
                ->where('a.categorie = :term')
                ->setParameter('term',$data1['query'])

                ->getQuery()
                ->getResult();

        }
        else{
            $recettes = $recetteRepository->findBy(array());
        }

        $search_form = $this->createForm(SearchRecette1Type::class);
        $search2_form = $this->createForm(SearchRecette2Type::class);

        return $this->render('rece_front/index.html.twig', [
            'recettes' => $recettes,
            'search_form' => $search_form->createView(),
            'search2_form' => $search2_form->createView(),
            'currentCart'=>$currentCart
        ]);
    }
    /**
     * @Route(  "/{id}/pdf",name="recette_pdf", methods={"GET"})
     */
    public function getPDF(Recette $recette )
    {
        $user = $this->getUser();
        $currentCart = $user->getCart();
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('recette_pdf/index.html.twig', [
            'recette' => $recette,
            'currentCart' => $currentCart
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("$recette.pdf", [
            "Attachment" => true
        ]);
    }
    /**
     * @Route("/rece/front/{id}/like", name="recette_like")
     */
    public function like(Recette $recette, EntityManagerInterface $entityManager, RecetteLikeRepository $recetteLikeRepository): Response
    {
        $user=$this->getUser();
        if (!$user)  return $this->json(['code' => 403, 'message' => 'Unauthorized'], 403);

        if($recette->isLikedByUser($user)){
            $like=$recetteLikeRepository->findOneBy([
                'Recette'=>$recette,
                'User'=>$user
            ]);
            $entityManager->remove($like);
            $entityManager->flush();
            return $this->json(['code' => 200, 'message' => 'like supprimé','likes' => $recetteLikeRepository->count(['Recette'=>$recette])],200);
        }
        $like=new RecetteLike();
        $like->setRecette($recette)
            ->setUser($user);
        $entityManager->persist($like);
        $entityManager->flush();
        return $this->json(['code' => 200, 'message' => 'like ajoutée','likes'=> $recetteLikeRepository->count(['Recette'=>$recette])],200);



    }

}
