<?php

namespace App\Controller;

use App\Service\OcrIndexerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentController extends AbstractController
{
    #[Route('/index-pdf', name: 'index_pdf')]
    public function indexPdf(OcrIndexerService $indexer): Response
    {
        $pdfFiles = glob('/app/textes_officiels/decrets/*.pdf');
        foreach ($pdfFiles as $pdfPath) {
            try {
                $indexer->processAndIndexPdf($pdfPath);
            } catch (\Exception $e) {
                dump('ERREUR indexPdf() MASSE');
                dd($e);
            }
        }

        return new Response("Indexation de " . count($pdfFiles) . " PDF terminée !");
    }
}