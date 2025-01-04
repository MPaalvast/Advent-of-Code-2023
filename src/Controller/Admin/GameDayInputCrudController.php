<?php

namespace App\Controller\Admin;

use App\Entity\GameDay;
use App\Entity\GameDayInput;
use App\Filter\GameDayYearFilter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class GameDayInputCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GameDayInput::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(GameDayYearFilter::new('id')
                ->setFormTypeOption('mapped', false)
                ->setLabel('Year')
            );
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('gameDay')->formatValue(function (GameDay $gameDay) {
                return $gameDay->getYear()?->getTitle();
            })->onlyOnIndex(),
            AssociationField::new('gameDay')->formatValue(function (GameDay $gameDay) {
                return $gameDay->getDay()?->getTitle();
            })->onlyOnIndex(),
            AssociationField::new('gameDay')
                ->onlyOnForms(),
            AssociationField::new('dayPart'),
            TextareaField::new('input'),
        ];
    }
}
