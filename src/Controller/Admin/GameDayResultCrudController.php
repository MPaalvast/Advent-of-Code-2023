<?php

namespace App\Controller\Admin;

use App\Entity\GameDay;
use App\Entity\GameDayResult;
use App\Filter\GameDayYearFilter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class GameDayResultCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GameDayResult::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(BooleanFilter::new('solved'))
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
            })->setLabel('Year'),
            AssociationField::new('gameDay')->formatValue(function (GameDay $gameDay) {
                return $gameDay->getDay()?->getTitle();
            }),
            AssociationField::new('dayPart'),
            BooleanField::new('solved'),
        ];
    }
}
