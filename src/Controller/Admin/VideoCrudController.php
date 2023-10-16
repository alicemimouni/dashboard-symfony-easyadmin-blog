<?php

namespace App\Controller\Admin;

use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichFileType;

class VideoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Video::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Vidéo')
            ->setEntityLabelInPlural('Vidéos'); 
    }

    public function configureFields(string $pageName): iterable
    {
       
        $uploadsDir = $this->getParameter('uploads_directory');
        $imagesDir = $this->getParameter('images_directory');

        yield TextField::new('url') 
        ->hideOnForm();

        yield TextField::new('videoFile', 'Vidéo')
        ->setFormType(VichFileType::class)->onlyOnForms();

        // poster
        $imageField = ImageField::new('poster')
            ->setBasePath($uploadsDir)
            ->setUploadDir($imagesDir)
            ->setUploadedFileNamePattern('[slug].[extension]');

        if (Crud::PAGE_EDIT == $pageName) {
            $imageField->setRequired(false);
        }

        yield $imageField;
        
    }

}
