<?php

namespace App\Controller\Admin;

use App\Entity\ProductDivision;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductDivisionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductDivision::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Divisions des produits')
            ->setEntityLabelInSingular('Division d\'un produit');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('title')
                ->setLabel('Titre'),
            AssociationField::new('subCategory')
                ->setLabel('Sous Catégorie'),
            BooleanField::new('isActive')
                ->setLabel('Activation'),
        ];
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
