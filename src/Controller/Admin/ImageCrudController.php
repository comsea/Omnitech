<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Galerie d\'images')
            ->setEntityLabelInSingular('Image');
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
                ->setLabel('Nom de l\'image'),
            ImageField::new('path')
                ->setLabel('Image')
                ->onlyWhenUpdating()
                ->setRequired(false)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            ImageField::new('path')
                ->setLabel('Image')
                ->hideWhenUpdating()
                ->setRequired(true)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
        ];
    }
}
