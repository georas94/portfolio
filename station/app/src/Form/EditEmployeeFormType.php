<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\RoleString;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class EditEmployeeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Prénom',
                'constraints' => [
                    new Regex('/^[a-zA-Z-]+$/')
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom',
                'constraints' => [
                    new Regex('/^[a-zA-Z-]+$/', 'Veuillez saisir du texte')
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Email',
                'constraints' => [
                    new Email([
                        'message' => 'Veuillez entrer un email valide',
                    ])
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    RoleString::ROLE_GAS_STATION_ATTENDANT->value => RoleString::ROLE_GAS_STATION_ATTENDANT->value,
                    RoleString::ROLE_MANAGER->value => RoleString::ROLE_MANAGER->value,
                ],
                'multiple' => true,
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Sauvegarder',
                'attr' => [
                    'class' => 'mdc-button mdc-button--raised mdc-ripple-upgraded'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'request' => [],
        ]);
    }
}
