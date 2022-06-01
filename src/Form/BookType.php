<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Positive;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Title
            ->add('title', TextType::class, [

                // Label
                'label' => "Titre du livre",
                'label_attr' => [
                    'class' => "form-label-test",
                ],

                // Rendre le champ obligatoire
                'required' => true,

                // Attributs du champs
                'attr' => [
                    'class' => "form-control",
                    'placeholder' => "Saisir le titre du livre",
                ],

                // Helper
                'help' => "Ajouter le titre du livre",
                'help_attr' => [
                    'class' => "text-muted",
                ],

                // Contraintes du champs
                'constraints' => [
                    new NotBlank([
                        'message' => "Le titre du livre est obligatoire",
                    ]),
                    new Length([
                        'max' => 180,
                        'maxMessage' => "Le titre ne peut contenir que {{ limit }} caractères"
                    ])
                ],
            ])

            // Description
            ->add('description', TextareaType::class, [

                // Label
                'label' => "Description du livre",
                'label_attr' => [
                    'class' => "form-label-test",
                ],

                // Rendre le champ obligatoire
                'required' => false,

                // Attributs du champs
                'attr' => [
                    'class' => "form-control",
                    'placeholder' => "Saisir la description du livre",
                ],

                // Helper
                'help' => "Ajouter la description du livre",
                'help_attr' => [
                    'class' => "text-muted",
                ]

                // Contraintes du champs
            ])

            // Cover (FileType)
            // Type image .jpg, .jpeg, .png
            // Taille 2Mo
            ->add('cover', FileType::class, [

                // Label
                'label' => "Couverture du livre",
                'label_attr' => [
                    'class' => "form-label-test",
                ],

                // Rendre le champ obligatoire
                'required' => false,

                // Attributs du champs
                'attr' => [
                    'class' => "form-control",
                    // 'multiple' => true,
                ],

                // Helper
                'help' => "Selectionner la description du livre",
                'help_attr' => [
                    'class' => "text-muted",
                ],

                // Contraintes du champs
                'constraints' => [
                    new Image([
                        'maxSize' => "1M",
                        'maxSizeMessage' => "Le fichier est trop volumineux {{size}} {{suffix}}. La taille max autorisée est {{ limit }} {{suffix}}",

                        'mimeTypes' => [
                            "image/jpeg",
                            "image/png",
                        ],
                        'mimeTypesMessage' => "Le type de fichier {{ type }} n'est pas valide. Les fichiers valide sont {{ types }}",
                    ])
                ],
            ])

            // Price (NumberType)
            // Supérieur à zero
            ->add('price', NumberType::class, [

                // Label
                'label' => "Prix du livre",
                'label_attr' => [
                    'class' => "form-label-test",
                ],

                // Rendre le champ obligatoire
                // 'required' => false,

                // Attributs du champs
                'attr' => [
                    'class' => "form-control",
                    // 'multiple' => true,
                    'placeholder' => "Ajouter le prix du livre",
                    'min' => 0,
                    'step' => 0.01,
                ],

                // Helper
                'help' => "Ajouter le prix du livre",
                'help_attr' => [
                    'class' => "text-muted",
                ],

                // Contraintes du champs
                'constraints' => [
                    new NotBlank([
                        'message' => "Le prix du livre est obligatoire",
                    ]),
                    new Positive([
                        'message' => "Le prix doit être supérieur à zéro."
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
