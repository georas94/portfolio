<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarcodeController extends AbstractController
{
    #[Route('/scan', name: 'app_barcode_scan')]
    public function scan(): Response
    {
        return $this->render('barcode_scanner/scanner.html.twig');
    }
}

