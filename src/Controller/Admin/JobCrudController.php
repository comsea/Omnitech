<?php

namespace App\Controller\Admin;

use App\Entity\Job;
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

class JobCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Job::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Offres d\'emploi')
            ->setEntityLabelInSingular('Offre d\'emploi');
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
            AssociationField::new('contractType')
                ->setLabel('Type de contrat'),
            AssociationField::new('contractSector')
                ->setLabel('Secteur du contrat'),
            TextEditorField::new('description')
                ->setLabel('Description'),
            ImageField::new('pdf')
                ->setLabel('PDF à télécharger')
                ->onlyWhenUpdating()
                ->setRequired(false)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            ImageField::new('pdf')
                ->setLabel('PDF à télécharger')
                ->hideWhenUpdating()
                ->setRequired(true)
                ->setBasePath($basePath)
                ->setUploadDir($publicDir . '/' . $basePath)
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            BooleanField::new('is_published')
                ->setLabel('Publication'),
            DateTimeField::new('created_at')
                ->setLabel('Créé le'),
            DateTimeField::new('updated_at')
                ->setLabel('Modifié le'),
        ];
    }
}
