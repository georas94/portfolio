<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/open-shop', name: 'app_open_shop')]
    public function index(): Response
    {
        return $this->render('shop/open-shop/index.html.twig');
    }
}
