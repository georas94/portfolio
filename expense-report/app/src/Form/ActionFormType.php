<?php

namespace App\Form;

use App\Entity\Expense;
use App\Service\ExpenseService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ActionFormType extends AbstractType
{
    private ExpenseService $expenseService;
    private TokenStorageInterface $token;

    public function __construct(ExpenseService $expenseService, TokenStorageInterface $token)
    {
        $this->expenseService = $expenseService;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
            $form = $event->getForm();
            $expense = $event->getData();
            if ($this->expenseService->canSendToTreasury($expense, $this->token->getToken()->getUser())){
                $form->add('validate', SubmitType::class);
            }

            if ($this->expenseService->canSendToManager($expense) && !$this->expenseService->canSendToTreasury($expense, $this->token->getToken()->getUser())){
                $form->add('to_manager', SubmitType::class);
            }
            if (ExpenseService::canReject($expense)){
                $form->add('reject', SubmitType::class);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Expense::class,
        ]);
    }
}