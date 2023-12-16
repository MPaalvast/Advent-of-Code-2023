<?php

namespace App\Controller;

use App\Form\DayType;
use App\Service\Days\Day10Service;
use App\Service\Days\Day11Service;
use App\Service\Days\Day12Service;
use App\Service\Days\Day13Service;
use App\Service\Days\Day14Service;
use App\Service\Days\Day15Service;
use App\Service\Days\Day16Service;
use App\Service\Days\Day17Service;
use App\Service\Days\Day18Service;
use App\Service\Days\Day19Service;
use App\Service\Days\Day2Service;
use App\Service\Days\Day20Service;
use App\Service\Days\Day21Service;
use App\Service\Days\Day22Service;
use App\Service\Days\Day23Service;
use App\Service\Days\Day24Service;
use App\Service\Days\Day25Service;
use App\Service\Days\Day3Service;
use App\Service\Days\Day4Service;
use App\Service\Days\Day5Service;
use App\Service\Days\Day6Service;
use App\Service\Days\Day7Service;
use App\Service\Days\Day8Service;
use App\Service\Days\Day9Service;
use App\Service\Tools\FileOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Days\Day1Service;

class AbstractDayController extends AbstractController
{
    public array $dayClass;

    public function __construct()
    {
        $this->dayClass = [
            1 => ['class' => Day1Service::class, 'title' => 'Trebuchet?!'],
            2 => ['class' => Day2Service::class, 'title' => 'Cube Conundrum'],
            3 => ['class' => Day3Service::class, 'title' => 'Gear Ratios'],
            4 => ['class' => Day4Service::class, 'title' => 'Scratchcards'],
            5 => ['class' => Day5Service::class, 'title' => 'If You Give A Seed A Fertilizer'],
            6 => ['class' => Day6Service::class, 'title' => 'Wait For It'],
            7 => ['class' => Day7Service::class, 'title' => 'Camel Cards'],
            8 => ['class' => Day8Service::class, 'title' => 'Haunted Wasteland'],
            9 => ['class' => Day9Service::class, 'title' => 'Mirage Maintenance'],
            10 => ['class' =>Day10Service::class, 'title' => 'Pipe Maze'],
            11 => ['class' =>Day11Service::class, 'title' => 'Cosmic Expansion'],
            12 => ['class' =>Day12Service::class, 'title' => 'Hot Springs'],
            13 => ['class' =>Day13Service::class, 'title' => 'Point of Incidence'],
            14 => ['class' =>Day14Service::class, 'title' => 'Parabolic Reflector Dish'],
            15 => ['class' =>Day15Service::class, 'title' => 'Lens Library'],
            16 => ['class' =>Day16Service::class, 'title' => 'The Floor Will Be Lava'],
            17 => ['class' =>Day17Service::class, 'title' => '???'],
            18 => ['class' =>Day18Service::class, 'title' => '???'],
            19 => ['class' =>Day19Service::class, 'title' => '???'],
            20 => ['class' =>Day20Service::class, 'title' => '???'],
            21 => ['class' =>Day21Service::class, 'title' => '???'],
            22 => ['class' =>Day22Service::class, 'title' => '???'],
            23 => ['class' =>Day23Service::class, 'title' => '???'],
            24 => ['class' =>Day24Service::class, 'title' => '???'],
            25 => ['class' =>Day25Service::class, 'title' => '???']
        ];
    }

    public function renderDayPage(Request $request, FileOptions $fileOptions, int $day): Response
    {
        if (!isset($this->dayClass[$day])) {
            return $this->redirectToRoute('app_home');
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
