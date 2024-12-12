<?php

namespace App\Controller\Admin;

use App\Entity\Day;
use App\Entity\DayPart;
use App\Entity\GameDay;
use App\Entity\GameDayInput;
use App\Entity\GameDayResult;
use App\Entity\Year;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private ChartBuilderInterface $chartBuilder,
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);
         return $this->render('admin/index.html.twig', [
             'chart' => $chart,
         ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<\>');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Site', 'fas fa-tachometer-alt', 'app_home');

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Configuration');
        yield MenuItem::linkToCrud('Year', 'fas fa-list', Year::class);
        yield MenuItem::linkToCrud('Day', 'fas fa-list', Day::class);
        yield MenuItem::linkToCrud('DayPart', 'fas fa-list', DayPart::class);

        yield MEnuItem::section('Game');
        yield MEnuItem::linkToCrud('Day', 'fas fa-list', GameDay::class);
        yield MEnuItem::linkToCrud('Input', 'fas fa-list', GameDayInput::class);
        yield MEnuItem::linkToCrud('Result', 'fas fa-list', GameDayResult::class);
    }
}
