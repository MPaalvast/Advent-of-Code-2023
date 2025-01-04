<?php

namespace App\Filter;

use App\Entity\GameDay;
use App\Entity\Year;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Filter\FilterInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FilterDataDto;
use EasyCorp\Bundle\EasyAdminBundle\Filter\FilterTrait;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\EntityFilterType;

class GameDayYearFilter implements FilterInterface
{
    use FilterTrait;

    public static function new(string $propertyName, $label = null): self
    {
        return (new self())
            ->setFilterFqcn(__CLASS__)
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(EntityFilterType::class)
            ->setFormTypeOption('value_type_options', [
                'class' => Year::class,
            ]);
    }

    public function apply(QueryBuilder $queryBuilder, FilterDataDto $filterDataDto, ?FieldDto $fieldDto, EntityDto $entityDto): void
    {
        $alias = 'year';
        $property = $filterDataDto->getProperty();
        $comparison = $filterDataDto->getComparison();
        $parameterName = $filterDataDto->getParameterName();
        $entityYear = $filterDataDto->getValue();
        $queryBuilder
            ->innerJoin(GameDay::class, 'gameDay', Expr\Join::WITH, 'entity.gameDay = gameDay.id')
            ->innerJoin(Year::class, $alias, Expr\Join::WITH, 'gameDay.year = year')
            ->andWhere(sprintf('%s.%s %s :%s', $alias, $property, $comparison, $parameterName))
            ->setParameter($parameterName, $entityYear);
    }
}