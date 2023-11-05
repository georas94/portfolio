<?php

namespace App\Form;

use App\Entity\Expense;
use App\Service\ExpenseService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ExpenseFormType extends AbstractType
{
    private ExpenseService $expenseService;
    private TokenStorageInterface $token;
    public function __construct(TokenStorageInterface $token, ExpenseService $expenseService)
    {
        $this->token = $token;
        $this->expenseService = $expenseService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('expenseItems', CollectionType::class, [
                'entry_type' => ExpenseItemFormType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('validate', SubmitType::class, [
                'label' => 'Envoyer au service comptabilité',
                'attr' => [
                    'class' => 'btn btn-imperial btn-employee-expense-create-validate'
                ]
            ])
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /** @var Expense $expense */
            $expense = $event->getData();
            $this->expenseService->createEmployeeDraftExpense($this->token->getToken()->getUser(), $expense);
        });

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Expense::class,
        ]);
    }
}