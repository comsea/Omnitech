<?php

namespace App\Controller\Admin;

use App\Entity\ProductSupplier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductSupplierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductSupplier::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Marques des produits')
            ->setEntityLabelInSingular('Marque d\'un produit');
    }

    public function configureFields(string $pageName): iterable
    {
        $publicDir = $this->getParameter('app.public_dir');
        $basePath = $this->getParameter('app.base_path');
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('name')
                ->setLabel('Titre'),
            ImageField::new('logo')
                ->setLabel('Logo')
                ->onlyWhenUpdating()
                ->setRequired(false)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            ImageField::new('logo')
                ->setLabel('Logo')
                ->hideWhenUpdating()
                ->setRequired(true)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            BooleanField::new('is_active')
                ->setLabel('Activation'),
        ];
    }
}
