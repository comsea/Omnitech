<?php

namespace App\Controller\Admin;

use App\Entity\WorkShop;
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

class WorkShopCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WorkShop::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Liste des articles')
            ->setEntityLabelInSingular('Article');
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
            TextField::new('panel')
                ->setLabel('Commande numérique'),
            AssociationField::new('articleCategory')
                ->setLabel('Catégorie'),
            ImageField::new('image')
                ->setLabel('Photo de couverture')
                ->onlyWhenUpdating()
                ->setRequired(false)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            ImageField::new('image')
                ->setLabel('Photo de couverture')
                ->hideWhenUpdating()
                ->setRequired(true)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            BooleanField::new('quality')
                ->setLabel('Neuf'),
            AssociationField::new('gallery')
                ->setLabel('Galerie d\'image'),
            AssociationField::new('supplier')
                ->setLabel('Fournisseur'),
            TextEditorField::new('description')
                ->setLabel('Description'),
            TextField::new('price')
                ->setLabel('Prix (en €)'),
            BooleanField::new('is_published')
                ->setLabel('Publication'),
            DateTimeField::new('created_at')
                ->setLabel('Créé le'),
            DateTimeField::new('updated_at')
                ->setLabel('Modifié le'),
        ];
    }
}
