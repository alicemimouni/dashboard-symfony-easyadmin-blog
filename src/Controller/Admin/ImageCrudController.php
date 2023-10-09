<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $imagesDir = $this->getParameter('images_directory');
        $uploadsDir = $this->getParameter('uploads_directory');

        yield TextField::new('url');
        yield TextField::new('alt', 'Texte alternatif')->onlyOnForms();


        $imageField = ImageField::new('url', 'Média')
            ->setBasePath($uploadsDir)
            ->setUploadDir($imagesDir)
            ->setUploadedFileNamePattern('[slug]-[uuid].[extension]');

        if (Crud::PAGE_EDIT == $pageName) {
            $imageField->setRequired(false);
        }

        yield $imageField;
    }
    
}
