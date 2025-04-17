<?php

namespace App\Form;

use App\Entity\AO;
use App\Entity\Soumission;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoumissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateSoumission', null, [
                'widget' => 'single_text',
            ])
            ->add('statut')
            ->add('entreprise', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('ao', EntityType::class, [
                'class' => AO::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Soumission::class,
        ]);
    }
}
