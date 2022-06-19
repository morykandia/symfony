<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();

        
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Produit');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        yield MenuItem::subMenu('Product', 'fas fa-newspaper')->setSubItems([
             MenuItem::linkToCrud(label: 'Tous les articles ', icon: 'fas fa-newspaper', entityFqcn: Product::class),
             MenuItem::linkToCrud(label: 'Ajouter', icon: 'fas fa-plus', entityFqcn: Product::class)->setAction(Crud::PAGE_NEW),
           
        ]);
    }
}
