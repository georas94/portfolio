<?php

namespace App\Form;

use App\Entity\Pump;
use App\Entity\Shift;
use App\Entity\User;
use App\Enum\StatusTypeString;
use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use App\Validator\GreaterThanToday as CustomValidator;

class ShiftEndFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('gasoilQuantityAtStart', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Quantité de gasoil de départ',
                'constraints' => [
                    new PositiveOrZero([
                        'message' => 'Veuillez entrer un nombre supérieur ou égal à 0',
                    ]),
                ],
                'disabled' => true,
            ])
            ->add('gasoilQuantityAtEnd', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Quantité de gasoil de fin',
                'constraints' => [
                    new PositiveOrZero([
                        'message' => 'Veuillez entrer un nombre supérieur ou égal à 0',
                    ]),
                ],
            ])
            ->add('essenceQuantityAtStart', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Quantité d\'essence de départ',
                'constraints' => [
                    new PositiveOrZero([
                        'message' => 'Veuillez entrer un nombre supérieur ou égal à 0',
                    ])
                ],
                'disabled' => true,
            ])
            ->add('essenceQuantityAtEnd', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Quantité d\'essence de fin',
                'constraints' => [
                    new PositiveOrZero([
                        'message' => 'Veuillez entrer un nombre supérieur ou égal à 0',
                    ])
                ],
            ])
//            ->add('endedAt', DateType::class, [
//                'attr' => [
//                    'class' => 'form-control',
//                ],
//                'widget' => 'single_text',
//                'label' => 'Fin de tournée',
//                'constraints' => [
//                    new NotBlank([
//                        'message' => 'Veuillez entrer date de fin de tournée',
//                    ]),
//                    new CustomValidator(),
//                ],
//            ])
            ->add('employee', EntityType::class, [
                'class' => User::class,
                'attr' => [
                    'class' => 'form-select',
                ],
                'label' => 'Responsable de cette tournée',
                'choice_label' => function (User $user): string {
                    return $user->getFirstname() . ' ' . $user->getLastname();
                },
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.lastname', 'ASC');
                },
                'disabled' => true,
            ])->add('pump', EntityType::class, [
                'class' => Pump::class,
                'attr' => [
                    'class' => 'form-select',
                ],
                'label' => 'Pompe',
                'choice_label' => function (Pump $pump): string {
                    return 'Pompe n° : ' . $pump->getId();
                },
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.id', 'ASC');
                },
                'disabled' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Sauvegarder',
                'attr' => [
                    'class' => 'mdc-button mdc-button--raised mdc-ripple-upgraded'
                ]
            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /** @var Shift $shift */
            $shift = $event->getData();
            $shift->setStatus(StatusTypeString::STATUS_COMPLETED->value);
            $shift->setEndedAt(new DateTime());
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Shift::class,
            'request' => [],
        ]);
    }
}
