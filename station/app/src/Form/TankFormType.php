<?php

namespace App\Form;

use App\Entity\Tank;
use App\Enum\FuelTypeString;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class TankFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('volume', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Volume',
                'constraints' => [
                    new PositiveOrZero([
                        'message' => 'Veuillez entrer un nombre supérieur ou égal à 0',
                    ]),
                ]
            ])
            ->add('quantityAvailable', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Quantité disponible',
                'constraints' => [
                    new PositiveOrZero([
                        'message' => 'Veuillez entrer un nombre supérieur ou égal à 0',
                    ])
                ]
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom de la cuve',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un nom',
                    ])
                ]
            ])
            ->add('fuelType', ChoiceType::class, [
                'choices'  => [
                    FuelTypeString::TYPE_ESSENCE->value => FuelTypeString::TYPE_ESSENCE->value,
                    FuelTypeString::TYPE_DIESEL->value => FuelTypeString::TYPE_DIESEL->value,
                ],
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Sauvegarder',
                'attr' => [
                    'class' => 'mdc-button mdc-button--raised mdc-ripple-upgraded'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tank::class,
            'request' => [],
        ]);
    }
}
