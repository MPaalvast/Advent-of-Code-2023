<?php

namespace App\Controller\Admin;

use App\Entity\GameDay;
use App\Entity\GameDayInput;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class GameDayInputCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GameDayInput::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
//            IdField::new('id'),
            AssociationField::new('gameDay')->formatValue(function (GameDay $gameDay) {
                return $gameDay->getYear()?->getTitle();
            }),
            AssociationField::new('gameDay')->formatValue(function (GameDay $gameDay) {
                return $gameDay->getDay()?->getTitle();
            }),
            AssociationField::new('dayPart'),
            TextareaField::new('input'),
        ];
    }
}
