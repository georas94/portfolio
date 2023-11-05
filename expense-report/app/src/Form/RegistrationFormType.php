<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\RoleString;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::Class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email',
                    ]),
                    new Email([
                        'message' => 'Veuillez entrer une adresse email valide',
                    ])
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('firstname', TextType::Class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un prénom',
                    ])
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('lastname', TextType::Class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un nom de famille',
                    ])
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('roles', CollectionType::class, [
                'entry_type' => ChoiceType::class,
                'allow_add' => true,
                'entry_options' => [
                    'label' => false,
                    'attr' => [
                        'class' => 'form-select'
                    ],
                    'choices' => [
                        'Employé' => RoleString::ROLE_EMPLOYEE->name,
                        'Comptabilité' => RoleString::ROLE_ACCOUNTANT->name,
                        'Trésorerie' => RoleString::ROLE_TREASURER->name,
                        'Direction' => RoleString::ROLE_MANAGER->name,
                    ]
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
