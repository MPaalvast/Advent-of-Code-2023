<?php

namespace App\Controller\Admin;

use App\Entity\GameDay;
use App\Entity\Year;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GameDayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GameDay::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(25)
            ;
    }

    public function configureFields(string $pageName): iterable
    {
//        return [
//            IdField::new('id')->hideOnForm(),
//            TextField::new('title'),
////            TextEditorField::new('description'),
//        ];
        yield IdField::new('id')->hideOnForm();
        yield AssociationField::new('year');
        yield AssociationField::new('day');
        yield TextField::new('title');
        yield ChoiceField::new('status')->onlyOnIndex();
    }

}
