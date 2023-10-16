<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use App\Entity\Image;
use App\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator) {

    }
    /**
     * @Route("/admin", name="admin")
     * @IsGranted("ROLE_AUTHOR")
     * 
     */
    public function index(): Response
    {

        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('login');
        }

        // $controller = $this->isGranted('ROLE_ADMIN') ?  : ArticleCrudController::class;

        // $url = $this->adminUrlGenerator
        //     ->setController($controller)
        //     ->generateUrl();

        $url = $this->adminUrlGenerator
            ->setController(ArticleCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bforweb le blog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Aller sur le site', 'fas fa-undo', 'default');
        
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        if ($this->isGranted('ROLE_AUTHOR')) {

            // articles
            yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
                    MenuItem::linkToCrud('Tous les articles', 'fas fa-newspaper', Article::class),
                    MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
                    MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class)
            ]);

            // medias
            yield MenuItem::subMenu('Médias', 'fas fa-photo-video')->setSubItems([
                MenuItem::linkToCrud('Images', 'fas fa-photo-video', Image::class),
                MenuItem::linkToCrud('Vidéos', 'fas fa-photo-video', Video::class),
            ]);

        }
    
        if ($this->isGranted('ROLE_ADMIN')) {

            // users
            yield MenuItem::subMenu('Comptes', 'fas fa-user')->setSubItems([
                MenuItem::linkToCrud('Tous les comptes', 'fas fa-user-friends', User::class),
                MenuItem::linkToCrud('Ajouter', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW)
            ]);
        }

    }
}
