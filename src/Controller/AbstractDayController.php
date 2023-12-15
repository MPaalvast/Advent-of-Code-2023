<?php

namespace App\Controller;

use App\Form\DayType;
use App\Service\Days\Day10;
use App\Service\Days\Day11;
use App\Service\Days\Day12;
use App\Service\Days\Day13;
use App\Service\Days\Day14;
use App\Service\Days\Day15;
use App\Service\Days\Day16;
use App\Service\Days\Day17;
use App\Service\Days\Day18;
use App\Service\Days\Day19;
use App\Service\Days\Day2;
use App\Service\Days\Day20;
use App\Service\Days\Day21;
use App\Service\Days\Day22;
use App\Service\Days\Day23;
use App\Service\Days\Day24;
use App\Service\Days\Day25;
use App\Service\Days\Day3;
use App\Service\Days\Day4;
use App\Service\Days\Day5;
use App\Service\Days\Day6;
use App\Service\Days\Day7;
use App\Service\Days\Day8;
use App\Service\Days\Day9;
use App\Service\Tools\FileOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Days\Day1;

class AbstractDayController extends AbstractController
{
    public array $dayClass;

    public function __construct()
    {
        $this->dayClass = [
            1 => ['class' => Day1::class, 'title' => 'Trebuchet?!'],
            2 => ['class' => Day2::class, 'title' => 'Cube Conundrum'],
            3 => ['class' => Day3::class, 'title' => 'Gear Ratios'],
            4 => ['class' => Day4::class, 'title' => 'Scratchcards'],
            5 => ['class' => Day5::class, 'title' => 'If You Give A Seed A Fertilizer'],
            6 => ['class' => Day6::class, 'title' => 'Wait For It'],
            7 => ['class' => Day7::class, 'title' => 'Camel Cards'],
            8 => ['class' => Day8::class, 'title' => 'Haunted Wasteland'],
            9 => ['class' => Day9::class, 'title' => 'Mirage Maintenance'],
            10 => ['class' =>Day10::class, 'title' => 'Pipe Maze'],
            11 => ['class' =>Day11::class, 'title' => 'Cosmic Expansion'],
            12 => ['class' =>Day12::class, 'title' => 'Hot Springs'],
            13 => ['class' =>Day13::class, 'title' => 'Point of Incidence'],
            14 => ['class' =>Day14::class, 'title' => 'Parabolic Reflector Dish'],
            15 => ['class' =>Day15::class, 'title' => 'Lens Library'],
            16 => ['class' =>Day16::class, 'title' => ''],
            17 => ['class' =>Day17::class, 'title' => ''],
            18 => ['class' =>Day18::class, 'title' => ''],
            19 => ['class' =>Day19::class, 'title' => ''],
            20 => ['class' =>Day20::class, 'title' => ''],
            21 => ['class' =>Day21::class, 'title' => ''],
            22 => ['class' =>Day22::class, 'title' => ''],
            23 => ['class' =>Day23::class, 'title' => ''],
            24 => ['class' =>Day24::class, 'title' => ''],
            25 => ['class' =>Day25::class, 'title' => '']
        ];
    }

    public function renderDayPage(Request $request, FileOptions $fileOptions, int $day): Response
    {
        if (!isset($this->dayClass[$day])) {
            throw new AccessDeniedException($request->getUri());
        }
        $dayService = new $this->dayClass[$day]['class'];
        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $rows = $fileOptions->getDayInput($formData, $day);

            if ($formData['day_part'] === 1) {
                $result = $dayService->generatePart1($rows);
            } else {
                $result = $dayService->generatePart2($rows);
            }
        } else {
            $result = '';
        }

        return $this->render('day.html.twig', [
            'day_nr' => $day,
            'day_title' => $this->dayClass[$day]['title'],
            'result' => $result,
            'form' => $form,
        ]);
    }
}
