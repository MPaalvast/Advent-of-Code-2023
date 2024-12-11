<?php

namespace App\Controller;

use App\Repository\GameDayRepository;
use App\Repository\YearRepository;
use App\Service\Tools\DayInputOptions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DayController extends AbstractDayController
{

    public function __construct(
        DaySelector $daySelector,
        private readonly GameDayRepository $gameDayRepository,
        private readonly YearRepository $yearRepository,
    )
    {
        parent::__construct($daySelector);
    }

    #[Route('/{year}', name: 'app_year_days')]
    public function yearDays(int $year): Response
    {
        $yearEntity = $this->yearRepository->findOneBy(['title' => $year]);
        if (null === $yearEntity) {
            throw $this->createNotFoundException(sprintf('Year "%s" not found.', $year));
        }

        return $this->render('days.html.twig', [
            'year' => $yearEntity,
            'yearGameDays' => $this->gameDayRepository->findBy(['year' => $yearEntity]),
        ]);
    }

    #[Route('/{year}/{day}', name: 'app_day')]
    public function day(
        Request $request,
        DayInputOptions $DayInputOptions,
        int $year,
        int $day
    ): Response
    {
        $yearEntity = $this->yearRepository->findOneBy(['title' => $year]);
        if (null === $yearEntity) {
            throw $this->createNotFoundException(sprintf('Year "%s" not found.', $year));
        }

        try {
            return $this->renderDayPage($request, $DayInputOptions, $yearEntity, $day);
        } catch (NotFoundHttpException $e) {
            throw $this->createNotFoundException(sprintf('Day "%s" of "%s" not found.', $day, $yearEntity->getTitle()), previous: $e);
        }

    }

}
