<?php

namespace App\Form;

use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use App\Form\ImageType;
use App\Form\VideoType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Titre',
                'label_attr' => [
                    'class' => 'form-label m-3'
                ],
                'attr' => [
                    'class' => 'form-control m-3 w-100'
                ]
            ])
            ->add('textContent', TextareaType::class, [
                'label' => 'Contenu',
                'label_attr' => [
                    'class' => 'form-label m-3'
                ],
                'attr' => [
                    'class' => 'form-control m-3 w-100',
                    'style' => 'height:300px'
                ]
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Images de la section',
                'label_attr' => [
                    'class' => 'form-label m-3'
                ] 
            ])
            ->add('videos', CollectionType::class, [
                'entry_type' => VideoType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Vidéo de la section',
                'label_attr' => [
                    'class' => 'form-label m-3'
                ] 
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
