<?php

namespace App\Controller\Admin;

use App\Entity\ProductSubDivision;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductSubDivisionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductSubDivision::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Sous divisions des produits')
            ->setEntityLabelInSingular('Sous division d\'un produit');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('title')
                ->setLabel('Titre'),
            AssociationField::new('subDivision')
                ->setLabel('Sous Division'),
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
