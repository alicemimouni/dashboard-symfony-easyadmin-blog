<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\HttpFoundation\Response;
use App\Form\SectionType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewArticle = Action::new('viewArticle', "Voir l'article")
            ->setHtmlAttributes([
                'target' => '_blank'
            ])
            ->linkToCrudAction('viewArticle');

        return $actions
            ->add(Crud::PAGE_EDIT, $viewArticle)
            ->add(Crud::PAGE_INDEX, $viewArticle);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityPermission('ROLE_AUTHOR');
    }

    
    public function configureFields(string $pageName): iterable
    {
       yield TextField::new('title', 'Titre');

       yield AssociationField::new('image')->onlyOnForms();

       yield SlugField::new('slug')->setTargetFieldName('title');

       yield DateTimeField::new('date');

       yield AssociationField::new('categories')->onlyOnForms();

       yield TextareaField::new('introduction')->onlyOnForms();
    
       yield CollectionField::new('sections')->setEntryType(SectionType::class)->onlyOnForms();
    
       yield TextareaField::new('conclusion')->onlyOnForms();

    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
       /** @var Article $article */
       $article = $entityInstance;

       foreach ($article->getSections() as $section) {
           $section->setArticle($article);

           foreach ($section->getParts() as $part) {
            $part->setSection($section);
        }
       }

       parent::persistEntity($entityManager, $article);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        /** @var Article $article */
        $article = $entityInstance;

        foreach ($article->getSections() as $section) {
            $section->setArticle($article);

            foreach ($section->getParts() as $part) {
                $part->setSection($section);
            }
        }

        parent::updateEntity($entityManager, $article);
    }

    public function removeEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $part = $entityManager->getRepository(Part::class)->find($id);

        if (!$part) {
            throw $this->createNotFoundException('Partie introuvable');
        }
    
        $entityManager->remove($part);
        $entityManager->flush();
    }

}
