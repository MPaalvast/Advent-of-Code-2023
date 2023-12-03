<?php

namespace App\Controller;

use App\Form\DayType;
use App\Service\Day4;
use App\Service\FileOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Day4Controller extends AbstractController
{
    #[Route('/day4', name: 'app_day4')]
    public function index(Request $request, FileOptions $fileOptions, Day4 $day4Service): Response
    {
        $day = 4;
        $result = '';
        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $rows = $fileOptions->getDayInput($formData, $day);

            if ($formData['day_part'] === 1) {
                $result = $day4Service->generatePart1($rows);
            } else {
                $result = $day4Service->generatePart2($rows);
            }
        }

        return $this->render('day.html.twig', [
            'day_nr' => $day,
            'day_title' => '???',
            'result' => $result,
            'form' => $form,
        ]);
    }
}