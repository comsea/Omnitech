<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Produits')
            ->setEntityLabelInSingular('Produit');
    }

    public function configureFields(string $pageName): iterable
    {
        $publicDir = $this->getParameter('app.public_dir');
        $basePath = $this->getParameter('app.base_path');
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('title')
                ->setLabel('Titre'),
            ImageField::new('image')
                ->setLabel('Image')
                ->onlyWhenUpdating()
                ->setRequired(false)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            ImageField::new('image')
                ->setLabel('Image')
                ->hideWhenUpdating()
                ->setRequired(true)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            AssociationField::new('category')
                ->setLabel('Catégorie'),
            AssociationField::new('sub_category')
                ->setLabel('Sous catégorie'),
            TextEditorField::new('description')
                ->setLabel('Description'),
            ImageField::new('file')
                ->setLabel('PDF à télécharger')
                ->onlyWhenUpdating()
                ->setRequired(false)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            ImageField::new('file')
                ->setLabel('PDF à télécharger')
                ->hideWhenUpdating()
                ->setRequired(true)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            TextEditorField::new('caracteristique')
                ->setLabel('Caractéristique'),
            AssociationField::new('supplier')
                ->setLabel('Marque'),
            BooleanField::new('is_published')
                ->setLabel('Publication'),
            DateTimeField::new('created_at')
                ->setLabel('Créé le')
                ->onlyWhenCreating(),
            DateTimeField::new('updated_at')
                ->setLabel('Modifié le'),
        ];
    }
}
