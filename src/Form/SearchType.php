<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // ->add('categories', EntityType::class, [
        //     'class' => Category::class,
        //     'multiple' => true,
        //     'label' => 'Catégories',
        //     'expanded' => true, 
        // ])
        ->add('searchBar', TextType::class, [
            'required' =>false,
            'label' =>false,
            'attr' => [
                    'class' => 'input-text',
                    'placeholder' => 'Rechercher',       
            ]         
        ])
        ->add('Go', SubmitType::class, [
            'attr' => [
                'class' => 'button',
            ]  
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
