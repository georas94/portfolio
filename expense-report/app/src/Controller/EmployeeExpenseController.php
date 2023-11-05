<?php

namespace App\Controller;

use App\Entity\Expense;
use App\Entity\ExpenseItem;
use App\Form\ExpenseFormType;
use App\Repository\ExpenseRepositoryInterface;
use App\Service\ExpenseService;
use Exception;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Throwable;

class EmployeeExpenseController extends AbstractController
{
    private ExpenseService $expenseService;
    private ExpenseRepositoryInterface $expenseRepository;
    private TranslatorInterface $translatorInterface;
    private ParameterBagInterface $params;

    public function __construct(
        ExpenseService $expenseService,
        ExpenseRepositoryInterface $expenseRepository,
        TranslatorInterface $translatorInterface,
        ParameterBagInterface $params
    )
    {
        $this->expenseService = $expenseService;
        $this->expenseRepository = $expenseRepository;
        $this->translatorInterface = $translatorInterface;
        $this->params = $params;
    }

    #[Route('/employee/expenses/dashboard', name: 'app_employee_dashboard')]
    public function employeeDashboard(): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new LogicException($this->translatorInterface->trans('app.error.user.not.found'));
        }

        $expensesResultSet = $this->expenseRepository->getEmployeeExpenses($this->getUser());

        return $this->render('employee/expense/dashboard/dashboard.html.twig', [
            'expensesResultSet' => $expensesResultSet
        ]);
    }

    #[Route('/employee/expenses/create', name: 'app_employee_expense_create')]
    public function create(Request $request): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new LogicException($this->translatorInterface->trans('app.error.user.not.found'));
        }
        $expense = new Expense();
        $form = $this->createForm(ExpenseFormType::class, $expense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Expense $expense */
            $expense = $form->getData();
            /** @var ExpenseItem $expenseItem */
            foreach($expense->getExpenseItems() as $expenseItem){
                try {
                    $expense = $this->expenseService->updateEmployeeExpense($expense, $expenseItem);
                    $this->addFlash('success', $this->translatorInterface->trans('app.success.expense.create'));
                    return $this->redirectToRoute('app_employee_expense_view', [
                        'id' => $expense->getId(),
                    ]);
                } catch (Throwable $e) {
                    throw new Exception($e->getMessage());
                }
            }
            return $this->redirectToRoute('app_home');
        }

        return $this->render('employee/expense/create/create.html.twig', [
            'expense' => $expense,
            'form' => $form->createView()
        ]);
    }

    #[Route('/employee/expenses/{id}/view', name: 'app_employee_expense_view')]
    public function view(Expense $expense): Response
    {
        return $this->render('employee/expense/view/view.html.twig', [
            'expense' => $expense
        ]);
    }

    #[Route('/employee/expenses/{id}/edit', name: 'app_employee_expense_edit')]
    public function edit(Expense $expense): Response
    {
        return $this->render('employee/expense/edit/edit.html.twig', [
            'expense' => $expense
        ]);
    }

    #[Route('/employee/expenses/file/{id}', name: 'app_employee_expense_file_download')]
    public function downloadImageAction(ExpenseItem $expenseItem): BinaryFileResponse
    {
        $extension = pathinfo($expenseItem->getImageName(), PATHINFO_EXTENSION);
        $newImageName = 'Justificatif_sous_note_'.$expenseItem->getId() . '.' . $extension;

        // send the file contents and force the browser to show it instead of downloading it
        return $this->file($this->params->get('expense_documents_directory').'/'.$expenseItem->getImageName(), $newImageName, ResponseHeaderBag::DISPOSITION_INLINE);
    }

    #[Route('/accueil', name: 'app_employee_home')]
    public function index(): Response
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/employee/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }
}
