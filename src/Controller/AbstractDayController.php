<?php

namespace App\Controller;

use App\Entity\GameDay;
use App\Entity\Year;
use App\Form\DayType;
use App\Service\Tools\DayInputOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbstractDayController extends AbstractController
{

    public function __construct(
        private readonly DaySelector $daySelector
    ){
    }

    public function renderDayPage(
        Request $request,
        DayInputOptions $DayInputOptions,
        Year $year,
        GameDay $gameDay
    ): Response
    {
        $index = 'Y'.$year->getTitle().'D'.$gameDay->getDay()?->getTitle();

        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $rows = $DayInputOptions->getDayInput($formData, $year, $gameDay);

            if (!$this->daySelector->isValidInput($index, $rows)) {
                $result = 'INVALID INPUT!!';
            } elseif ($formData['day_part'] === 1) {
                $result = $this->daySelector->generatePart1($index, $rows);
            } else {
                $result = $this->daySelector->generatePart2($index, $rows);
            }
        } else {
            $result = '';
        }

        return $this->render('day.html.twig', [
            'game_day' => $gameDay,
            'year' => $year,
            'result' => $result,
            'form' => $form,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 202));
    }
}
