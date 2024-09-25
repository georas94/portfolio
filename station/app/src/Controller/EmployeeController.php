<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    #[Route('/employee-list', name: 'app_list_employee')]
    public function index(): Response
    {
        return $this->render('employee/list.html.twig', [
            'employees' => $this->userRepository->findAll(),
        ]);
    }
}
