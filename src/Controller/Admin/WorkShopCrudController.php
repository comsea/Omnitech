<?php

namespace App\Controller\Admin;

use App\Entity\WorkShop;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WorkShopCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WorkShop::class;
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
