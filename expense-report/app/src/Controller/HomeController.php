<?php

namespace App\Controller;

use App\Enum\RoleString;
use App\Repository\ExpenseRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private ExpenseRepositoryInterface $expenseRepositoryInterface;

    /**
     * @param ExpenseRepositoryInterface $expenseRepositoryInterface
     */
    public function __construct(ExpenseRepositoryInterface $expenseRepositoryInterface)
    {
        $this->expenseRepositoryInterface = $expenseRepositoryInterface;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('app_login');
        }

        if(in_array(RoleString::ROLE_EMPLOYEE->name, $user->getRoles())){
            return $this->render('home/employee/index.html.twig', [
                'user' => $this->getUser()
            ]);
        }else {
            return $this->render('home/managerial/index.html.twig', [
                'user' => $this->getUser(),
                'expensesResultSet' => $this->expenseRepositoryInterface->getManagerialExpensesToValidate($user)
            ]);
        }
    }
}
