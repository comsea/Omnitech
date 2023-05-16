<?php

namespace App\Controller\Admin;

use App\Entity\News;
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

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Actualités')
            ->setEntityLabelInSingular('Actualité');
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
            TextField::new('subtitle')
                ->setLabel('Phrase d\'accorche'),
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
            AssociationField::new('newsCategory')
                ->setLabel('Catégorie'),
            TextEditorField::new('description')
                ->setLabel('Description'),
            BooleanField::new('is_published')
                ->setLabel('Publication'),
            DateTimeField::new('created_at')
                ->setLabel('Créé le'),
            DateTimeField::new('updated_at')
                ->setLabel('Modifié le'),
        ];
    }
}
