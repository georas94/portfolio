<?php

namespace App\Form;

use App\Entity\ShoppingCartItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity', null, [
                'label' => 'Quantité'
            ])
            ->add('remove', SubmitType::class, [
                'label' => '<i class="fa-regular fa-trash-can"></i>',
                'label_html' => true,
                'attr' => [
                    'style' => 'border:none'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ShoppingCartItem::class,
        ]);
    }
}
