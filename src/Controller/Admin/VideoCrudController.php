<?php

namespace App\Controller\Admin;

use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class VideoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Video::class;
    }

    public function configureFields(string $pageName): iterable
    {
       
        $videosDir = $this->getParameter('videos_directory');
        $uploadsDir = $this->getParameter('uploads_directory');

        yield TextField::new('url');
        yield TextField::new('poster');

        $videoField = ImageField::new('url', 'Média')
            ->setBasePath($uploadsDir)
            ->setUploadDir($videosDir)
            ->setUploadedFileNamePattern('[slug]-[uuid].[extension]');

        if (Crud::PAGE_EDIT == $pageName) {
            $videoField->setRequired(false);
        }

        yield $videoField;
        
    }

}
