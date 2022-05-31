<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
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

                // Attributs du champs

                // Helper

                // Contraintes du champs
            ])

            // Description
            ->add('description')

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
