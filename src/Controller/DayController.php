<?php

namespace App\Controller;

use App\Service\Tools\FileOptions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DayController extends AbstractDayController
{

    #[Route('/{year}/days', name: 'app_year_days')]
    public function yearDays(Request $request, FileOptions $fileOptions, int $year): Response
    {
        return $this->render('days.html.twig', [
            'year' => $year,
        ]);
    }

    #[Route('/{year}/days/{day}', name: 'app_day')]
    public function day(Request $request, FileOptions $fileOptions, int $year, int $day): Response
    {
        return $this->renderDayPage($request, $fileOptions, $year, $day);
    }

}
