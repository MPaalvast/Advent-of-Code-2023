<?php

namespace App\Controller\Admin;

use App\Entity\GameDay;
use App\Entity\GameDayResult;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class GameDayResultCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GameDayResult::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('gameDay')->formatValue(function (GameDay $gameDay) {
                return $gameDay->getYear()?->getTitle();
            }),
            AssociationField::new('gameDay')->formatValue(function (GameDay $gameDay) {
                return $gameDay->getDay()?->getTitle();
            }),
            AssociationField::new('dayPart'),
            BooleanField::new('solved'),
        ];
    }
}
