<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                ]

                // Contraintes du champs
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
                ]
            ])

            // Price (NumberType)
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
                    'placeholder' => "Prix du livre",
                    'min' => 0,
                    'step' => 0.01,
                ],

                // Helper
                'help' => "Prix du livre",
                'help_attr' => [
                    'class' => "text-muted",
                ]
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
