<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', TextType::class, [
                'label' => 'Url de l\'image PNG ou JPG',
                'label_attr' => [
                    'class' => 'form-label m-3'
                ],
                'attr' => [
                    'class' => 'form-control w-100 m-3'
                ]
            ])
            ->add('alt', TextType::class, [
                'label' => 'Texte alternatif de l\'image',
                'label_attr' => [
                    'class' => 'form-label m-3'
                ],
                'attr' => [
                    'class' => 'form-control w-100 m-3'
                ]
            ])
            // ->add('url_avif', TextType::class, [
            //     'label' => 'Url de l\'image AVIF',
            //     'label_attr' => [
            //         'class' => 'form-label m-3'
            //     ],
            //     'attr' => [
            //         'class' => 'form-control w-100 m-3'
            //     ]
            // ])
            // ->add('url_webp')
            // ->add('sections')
            // ->add('category')
            // ->add('url', FileType::class, [
            //     'label' => 'Télécharger une image',
            //     'required' => false, 
            //     'data_class' => File::class
            // ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
