<?php

namespace App\Form;

use App\Entity\ExpenseItem;
use App\Enum\ExpenseTypeString;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ExpenseItemFormType extends AbstractType
{
    private TranslatorInterface $translatorInterface;

    public function __construct(TranslatorInterface $translatorInterface)
    {
        $this->translatorInterface = $translatorInterface;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('expenseType', ChoiceType::class, [
                'label' => 'Type de dépense :',
                'attr' => [
                    'class' => 'form-select'
                ],
                'label_attr' => ['class' => 'expense-create-expenseType-label mt-3 mb-1'],
                'choices' => [
                    ExpenseTypeString::TYPE_RESTAURANT->value => ExpenseTypeString::TYPE_RESTAURANT->name,
                    ExpenseTypeString::TYPE_PEAGE->value => ExpenseTypeString::TYPE_PEAGE->name,
                    ExpenseTypeString::TYPE_DIVERS->value => ExpenseTypeString::TYPE_DIVERS->name,
                    ExpenseTypeString::TYPE_PARKING->value => ExpenseTypeString::TYPE_PARKING->name,
                    ExpenseTypeString::TYPE_TAXI->value => ExpenseTypeString::TYPE_TAXI->name,
                    ExpenseTypeString::TYPE_VOITURE->value => ExpenseTypeString::TYPE_VOITURE->name
                ]
            ])
            ->add('comment', TextareaType::Class, [
                'label' => 'Commentaire :',
                'constraints' => [
                    new NotBlank([
                        'message' => $this->translatorInterface->trans('app.error.notBlank'),
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'rows' => '5'
                ],
                'label_attr' => [
                    'class' => 'expense-create-comment-label mt-3 mb-1',
                ]
            ])
            ->add('isAdvanceTaken', CheckboxType::class, [
                'required' => false,
                'label' => 'Frais avancés :',
                'attr' => [
                    'class' => 'big-checkbox form-check-input mt-3 expense-create-isAdvanceTaken-input'
                ],
                'label_attr' => ['class' => 'expense-create-isAdvanceTaken-label mt-3 mb-1'],
            ])
            ->add('advancedFeesAmount', IntegerType::class, [
                'label' => 'Montant des frais avancés :',
                'attr' => [
                    'class' => 'form-control expense-create-advancedFeesAmount-input',
                    'style' => 'display:none;'
                ],
                'label_attr' => [
                    'class' => 'expense-create-advancedFeesAmount-label mt-3 mb-1',
                    'style' => 'display:none;'
                ],
                'required' => false
            ])
            ->add('imageFile', VichFileType::class, [
                'label' => 'Justificatif (.pdf, .png, .jpg) :',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => ['class' => 'expense-create-imageFile-label mt-3 mb-1'],
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'image/png',
                            'image/jpeg',
                            'image/pjpeg'
                        ],
                        'mimeTypesMessage' => $this->translatorInterface->trans('app.error.expense.create.document.mimeType'),
                        'uploadIniSizeErrorMessage' => $this->translatorInterface->trans('app.error.expense.create.document.size'),
                    ])
                ],
                'required' => false,
                'allow_delete' => true,
            ])
            ->add('amount', IntegerType::class, [
                'label' => 'Montant :',
                'attr' => [
                    'class' => 'form-control',
                    'type' => 'number',
                    'min'=> '1'
                ],
                'label_attr' => ['class' => 'expense-create-amount-label mt-3 mb-1'],
                'invalid_message' => $this->translatorInterface->trans('app.error.expense.create.amount'),
                'constraints' => [
                    new NotBlank([
                        'message' => $this->translatorInterface->trans('app.error.expense.create.notBlank'),
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExpenseItem::class,
        ]);
    }
}
