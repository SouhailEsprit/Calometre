<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class RecettePDFController extends AbstractController
{
    /**
     * @Route("/recette/p/d/f", name="app_recette_p_d_f")
     */

    public function index()
    {
$pdfOptions = new Options();
$pdfOptions->set('defaultFont', 'Arial');

    // Instantiate Dompdf with our options
$dompdf = new Dompdf($pdfOptions);

    // Retrieve the HTML generated in our twig file
$html = $this->renderView('recette_pdf/index.html.twig', [
'title' => "Welcome to our PDF Test"
]);

    // Load HTML to Dompdf
$dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
$dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
$dompdf->render();

    // Output the generated PDF to Browser (inline view)
$dompdf->stream("mypdf.pdf", [
"Attachment" => false
]);
}
}
