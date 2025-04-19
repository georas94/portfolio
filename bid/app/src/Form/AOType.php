<?php

namespace App\Form;

use App\Entity\AO;
use App\Service\AO\StatutAOUtils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AOType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isCreation = $options['data'] && $options['data']->getId() === null;
        $builder
            ->add('reference')
            ->add('titre')
            ->add('entreprise')
            ->add('description')
            ->add('dateLimite', null, [
                'widget' => 'single_text',
            ])
            ->add('budget')
            ->add('statut', ChoiceType::class, [
                'choices' => StatutAOUtils::getChoices($isCreation),
                'label' => 'Statut',
                'attr' => [
                    'class' => 'h-8 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md'
                ]
            ])
            ->add('documents', FileType::class, [
                'label' => 'Pièces jointes',
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'hidden',
                    'id' => 'file-upload'
                ]
            ]);
        // Ajouter le champ regenerate_pdf seulement si l'entité existe déjà (modification)
        if ($options['data'] && $options['data']->getPdfPath() !== null) {
            $builder->add('regenerate_pdf', CheckboxType::class, [
                'label' => 'Re-générer le PDF',
                'required' => false,
                'mapped' => false,
                'help' => 'Cocher pour re-générer le document PDF après modification'
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AO::class,
        ]);
    }
}
