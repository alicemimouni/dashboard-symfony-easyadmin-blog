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


class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
       yield TextField::new('title', 'Titre');

       yield AssociationField::new('image')->onlyOnForms();

       yield SlugField::new('slug')->setTargetFieldName('title');

       yield DateTimeField::new('date');

       yield AssociationField::new('categories')->onlyOnForms();

       yield TextEditorField::new('introduction')->onlyOnForms();
    
       yield AssociationField::new('sections')->onlyOnForms();

    }
    
}
