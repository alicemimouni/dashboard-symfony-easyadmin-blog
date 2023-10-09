<?php

namespace App\Form;

use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\PartType;

class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Titre de la section',
                'required' => false,
                'empty_data' => ''
            ])
            ->add('textContent', TextareaType::class, [
                'label' => 'Contenu'
            ])
            ->add('images')
            ->add('videos')
            ->add('parts', CollectionType::class, [
                'label' => 'Parties',
                'entry_type' => PartType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false //Ensures that part modifications are tracked
            // 'entry_options' => ['label' => false],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Section::class,
        ]);
    }
}
