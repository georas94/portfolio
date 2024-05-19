<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private ProductRepository $productRepository)
    {}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig',[
            'products' => $this->productRepository->findBy([], null, 4)
        ]);
    }

    #[Route('/privacy-policy', name: 'app_privacy_policy')]
    public function privacyPolicy(): Response
    {
        return $this->render('home/privacy-policy/index.html.twig');
    }
}
