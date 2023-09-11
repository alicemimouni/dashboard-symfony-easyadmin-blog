<?php

namespace App\Form;

use App\Entity\Article;
use App\Form\SectionType;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'label_attr' => [
                    'class' => 'form-label m-3 text-uppercase'
                ],
                'attr' => [
                    'class' => 'form-control m-3 w-100'
                ]
            ])
            ->add('date', DateType::class, [
                'label' => 'Date de publication',
                'label_attr' => [
                    'class' => 'form-label m-3 text-uppercase'
                ],
                'format' => 'dd MM yyyy',
                'attr' => [
                    'class' => 'form-control m-3 w-100'
                ]
            ])
            ->add('categories', EntityType::class, [
                'class'=> Category::class,
                'multiple'=> true,
                'expanded'=> true,
                'label' => 'Catégories',
                'label_attr' => [
                    'class' => 'form-label m-3 text-uppercase'
                ],
                'attr' => [
                    'class'=> 'form-control m-3',
                ] 
            ])
            ->add('image', FileType::class, [
                'label' => 'Image de l\'article',
                'label_attr' => [
                    'class' => 'form-label m-3 text-uppercase',
                ],
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'm-3 form-control'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1g',
                        'mimeTypes' => [
                            'image/*'
                        ],
                        'mimeTypesMessage' => 'Image invalide',
                        'maxSizeMessage' => 'Le fichier est trop lourd'
                    ])
                ],
            ])
            ->add('introduction', TextareaType::class, [
                'label' => 'Introduction',
                'label_attr' => [
                    'class' => 'form-label m-3 text-uppercase'
                ],
                'attr' => [
                    'class' => 'form-control m-3 w-100',
                    'style' => 'height:300px'
                ]
            ])
            ->add('sections', CollectionType::class, [
                'entry_type' => SectionType::class,
                'label' => 'Sections',
                'label_attr' => [
                    'class' => 'form-label m-3 text-uppercase'
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false, // Important pour gérer les modifications
            ])

            ->add('conclusion', TextareaType::class, [
                'label' => 'Conclusion',
                'label_attr' => [
                    'class' => 'form-label m-3 text-uppercase'
                ],
                'attr' => [
                    'class' => 'form-control m-3 w-100',
                    'style' => 'height:300px'
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
