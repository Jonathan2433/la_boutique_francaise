<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

  
    public function configureFields(string $pageName): iterable
    {
        //  configuration des champs de formulaire d'ajoute d'un produit en bdd depuis easyadmin
        return [
            TextField::new('name'),
            // slug du nom de produit
            SlugField::new('slug')->setTargetFieldName('name'),

            ImageField::new('illustration')
            // fichier de destination
            ->setBasePath('uploads/')
            // fichier de destination depuis la racine
            ->setUploadDir('public/uploads/')
            //  randomisation du nom des images 
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            // champs non requis
            ->setRequired(false),

            TextField::new('subtitle'),
            TextareaField::new('description'),

            
            MoneyField::new('price')->setCurrency('EUR'),
            AssociationField::new('category')
        ];
    }

}
