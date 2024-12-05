<?php

namespace App\Controller\Admin;

use App\Entity\Day;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class DayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Day::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(25)
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('title'),
        ];
    }
}
