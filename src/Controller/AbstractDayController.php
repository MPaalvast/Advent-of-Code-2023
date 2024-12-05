<?php

namespace App\Controller;

use App\Entity\Year;
use App\Form\DayType;
use App\Service\Tools\FileOptions;
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
        FileOptions $fileOptions,
        Year $year,
        int $day): Response
    {
        $index = 'Y'.$year->getTitle().'D'.$day;

        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $rows = $fileOptions->getDayInput($formData, $year, $day);

            if ($formData['day_part'] === 1) {
                $result = $this->daySelector->generatePart1($index, $rows);
            } else {
                $result = $this->daySelector->generatePart2($index, $rows);
            }
        } else {
            $result = '';
        }

        return $this->render('day.html.twig', [
            'day_nr' => $day,
            'year' => $year,
            'day_title' => $this->daySelector->getTitle($index),
            'result' => $result,
            'form' => $form,
        ]);
    }
}
