<?php

namespace App\Form;

use App\Entity\Pump;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class PumpFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gasoilQuantity', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Quantité de gasoil',
                'constraints' => [
                    new PositiveOrZero([
                        'message' => 'Veuillez entrer un nombre supérieur ou égal à 0',
                    ]),
                ]
            ])
            ->add('essenceQuantity', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Quantité d\'essence',
                'constraints' => [
                    new PositiveOrZero([
                        'message' => 'Veuillez entrer un nombre supérieur ou égal à 0',
                    ])
                ]
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Responsables de cette pompe',
                'multiple' => true,
                'choice_label' => function (User $user): string {
                    return $user->getFirstname() . ' ' . $user->getLastname();
                },
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.lastname', 'ASC');
                },
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
            'data_class' => Pump::class,
            'request' => [],
        ]);
    }
}
