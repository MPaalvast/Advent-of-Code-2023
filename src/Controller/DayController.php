<?php

namespace App\Controller;

use App\Service\Tools\FileOptions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DayController extends AbstractDayController
{
    #[Route('/days', name: 'app_days')]
    public function days(Request $request, FileOptions $fileOptions): Response
    {
        return $this->render('days.html.twig', [

        ]);
    }

    #[Route('/days/{day}', name: 'app_day')]
    public function day(Request $request, FileOptions $fileOptions, int $day): Response
    {
        return $this->renderDayPage($request, $fileOptions, $day);
    }

}
