<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ProductsCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Products::class;
  }


  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id')->hideOnForm(),
      TextField::new('name'),
      SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
      TextEditorField::new('description'),
      TextEditorField::new('moreInformations'),
      MoneyField::new('price')->setCurrency('EUR'),
      IntegerField::new('quantity'),
      TextField::new('tags'),
      BooleanField::new('isBestSeller'),
      BooleanField::new('isNewArrival'),
      BooleanField::new('isFeatured'),
      BooleanField::new('isSpecialOffer'),
      AssociationField::new('category'),
      ImageField::new('image')
        ->setBasePath('uploads/products')
        ->setUploadDir('public/uploads/products')
        ->setUploadedFileNamePattern('[randomhash].[extension]')
        ->setRequired(false),
    ];
  }
}
