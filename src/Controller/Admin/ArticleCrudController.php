<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
       yield TextField::new('title', 'Titre');

       yield AssociationField::new('image');

       yield SlugField::new('slug')->setTargetFieldName('title');

       yield DateTimeField::new('date')->hideOnForm();

       yield AssociationField::new('categories');

       yield TextEditorField::new('introduction');
    
       yield AssociationField::new('sections');

    }
    
}
