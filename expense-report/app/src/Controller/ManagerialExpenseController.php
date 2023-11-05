<?php

namespace App\Controller;

use App\Entity\Expense;
use App\Form\ActionFormType;
use App\Repository\ExpenseRepositoryInterface;
use App\Service\ExpenseService;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

class ManagerialExpenseController extends AbstractController
{
    private TranslatorInterface $translatorInterface;
    private ExpenseService $expenseService;
    private ExpenseRepositoryInterface $expenseRepositoryInterface;

    public function __construct(ExpenseService $expenseService, ExpenseRepositoryInterface $expenseRepositoryInterface, TranslatorInterface $translatorInterface)
    {
        $this->expenseService = $expenseService;
        $this->expenseRepositoryInterface = $expenseRepositoryInterface;
        $this->translatorInterface = $translatorInterface;
    }

    #[Route('/managerial/expenses/dashboard', name: 'app_managerial_expense_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new LogicException($this->translatorInterface->trans('app.error.user.not.found'));
        }

        $expensesResultSet = $this->expenseRepositoryInterface->getManagerialExpenses($this->getUser());

        return $this->render('managerial/expense/dashboard/dashboard.html.twig', [
            'expensesResultSet' => $expensesResultSet
        ]);
    }

    #[Route('/managerial/expenses/{id}/view', name: 'app_managerial_expense_view')]
    public function view(Expense $expense): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new LogicException($this->translatorInterface->trans('app.error.user.not.found'));
        }

        return $this->render('managerial/expense/view/view.html.twig', [
            'expense' => $expense
        ]);
    }

    #[Route('/managerial/{id}/edit', name: 'app_managerial_expense_edit')]
    public function edit(Expense $expense, Request $request): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new LogicException($this->translatorInterface->trans('app.error.user.not.found'));
        }

        $form = $this->createForm(ActionFormType::class, $expense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->expenseService->canSendToTreasury($expense, $user)){
                if ($form->getClickedButton() === $form->get('validate')){
                    $this->expenseService->sendExpenseToNextLevel($expense);
                }
            }

            if ($this->expenseService->canSendToManager($expense)){
                if ($form->getClickedButton() === $form->get('to_manager')) {
                    $this->expenseService->sendToManager($expense);
                }
            }
            if (ExpenseService::canReject($expense)){
                if($form->getClickedButton() === $form->get('reject')){
                    $this->expenseService->rejectExpense($expense);
                }
            }

            return $this->redirectToRoute('app_managerial_expense_view', ['id' => $expense->getId()]);
        }

        return $this->render('managerial/expense/edit/edit.html.twig', [
            'expense' => $expense,
            'canEdit' => ExpenseService::canEdit($expense, $this->getUser()),
            'canReject' => ExpenseService::canReject($expense),
            'canSendToManager' => $this->expenseService->canSendToManager($expense),
            'canSendToTreasury' => $this->expenseService->canSendToTreasury($expense, $user),
            'actionForm' => $form->createView()
        ]);
    }

    #[Route('/accueil', name: 'app_manager_home')]
    public function home(): Response
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/manager/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }
}
