<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
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

            // Cover
            ->add('cover')

            // Price
            ->add('price')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
