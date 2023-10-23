<?php

namespace App\Controller\Admin;

use App\Entity\ArticleCategory;
use App\Entity\ContractSector;
use App\Entity\ContractType;
use App\Entity\Image;
use App\Entity\Job;
use App\Entity\News;
use App\Entity\NewsCategory;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ProductSubCategory;
use App\Entity\ProductSupplier;
use App\Entity\Supplier;
use App\Entity\User;
use App\Entity\WorkShop;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('dashboard/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('OMNITECHNIQUE | Panel administrateur')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::subMenu('Actualités', 'fas fa-newspaper')->setSubItems([
                MenuItem::linkToCrud('Actualités', 'fas fa-newspaper', News::class),
                MenuItem::linkToCrud('Catégories des actualités', 'fa fa-tags', NewsCategory::class),
            ]),
            MenuItem::subMenu('Boutique', 'fas fa-shopping-basket')->setSubItems([
                MenuItem::linkToCrud('Boutique', 'fas fa-shopping-basket', WorkShop::class),
                MenuItem::linkToCrud('Catégories des articles', 'fa fa-tags', ArticleCategory::class),
                MenuItem::linkToCrud('Fournisseurs', 'fa fa-industry', Supplier::class),
            ]),
            MenuItem::subMenu('Demandes d\'emplois', 'fas fa-briefcase')->setSubItems([
                MenuItem::linkToCrud('Emplois', 'fas fa-briefcase', Job::class),
                MenuItem::linkToCrud('Types des contrats', 'fa-solid fa-file-contract', ContractType::class),
                MenuItem::linkToCrud('Secteurs des contrats', 'fa-solid fa-file-contract', ContractSector::class),
            ]),
            MenuItem::subMenu('Produits', 'fas fa-industry')->setSubItems([
                MenuItem::linkToCrud('Produits', 'fas fa-industry', Product::class),
                MenuItem::linkToCrud('Catégories des produits', 'fa fa-tags', ProductCategory::class),
                MenuItem::linkToCrud('Sous catégories des produits', 'fa fa-tags', ProductSubCategory::class),
                MenuItem::linkToCrud('Marques des produits', 'fa fa-industry', ProductSupplier::class),
            ]),
            MenuItem::linkToCrud('Galerie d\'images', 'fa fa-picture-o', Image::class),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class),
            // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        ];
    }
}
