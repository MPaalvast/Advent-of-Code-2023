<?php

namespace App\Controller\Admin;

use App\Entity\DayPart;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class DayPartCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DayPart::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('title'),
        ];
    }
}
