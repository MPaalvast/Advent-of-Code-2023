<?php

namespace App\Controller;

use App\Form\DayType;
use App\Service\Days\Year2023\Y2023D10Service;
use App\Service\Days\Year2023\Y2023D11Service;
use App\Service\Days\Year2023\Y2023D12Service;
use App\Service\Days\Year2023\Y2023D13Service;
use App\Service\Days\Year2023\Y2023D14Service;
use App\Service\Days\Year2023\Y2023D15Service;
use App\Service\Days\Year2023\Y2023D16Service;
use App\Service\Days\Year2023\Y2023D17Service;
use App\Service\Days\Year2023\Y2023D18Service;
use App\Service\Days\Year2023\Y2023D19Service;
use App\Service\Days\Year2023\Y2023D20Service;
use App\Service\Days\Year2023\Y2023D21Service;
use App\Service\Days\Year2023\Y2023D22Service;
use App\Service\Days\Year2023\Y2023D23Service;
use App\Service\Days\Year2023\Y2023D24Service;
use App\Service\Days\Year2023\Y2023D25Service;
use App\Service\Days\Year2023\Y2023D2Service;
use App\Service\Days\Year2023\Y2023D3Service;
use App\Service\Days\Year2023\Y2023D4Service;
use App\Service\Days\Year2023\Y2023D5Service;
use App\Service\Days\Year2023\Y2023D6Service;
use App\Service\Days\Year2023\Y2023D7Service;
use App\Service\Days\Year2023\Y2023D8Service;
use App\Service\Days\Year2023\Y2023D9Service;
use App\Service\Days\Year2023\Y2023D1Service;
use App\Service\Days\Year2024\Y2024D10Service;
use App\Service\Days\Year2024\Y2024D11Service;
use App\Service\Days\Year2024\Y2024D12Service;
use App\Service\Days\Year2024\Y2024D13Service;
use App\Service\Days\Year2024\Y2024D14Service;
use App\Service\Days\Year2024\Y2024D15Service;
use App\Service\Days\Year2024\Y2024D16Service;
use App\Service\Days\Year2024\Y2024D17Service;
use App\Service\Days\Year2024\Y2024D18Service;
use App\Service\Days\Year2024\Y2024D19Service;
use App\Service\Days\Year2024\Y2024D1Service;
use App\Service\Days\Year2024\Y2024D20Service;
use App\Service\Days\Year2024\Y2024D21Service;
use App\Service\Days\Year2024\Y2024D22Service;
use App\Service\Days\Year2024\Y2024D23Service;
use App\Service\Days\Year2024\Y2024D24Service;
use App\Service\Days\Year2024\Y2024D25Service;
use App\Service\Days\Year2024\Y2024D2Service;
use App\Service\Days\Year2024\Y2024D3Service;
use App\Service\Days\Year2024\Y2024D4Service;
use App\Service\Days\Year2024\Y2024D5Service;
use App\Service\Days\Year2024\Y2024D6Service;
use App\Service\Days\Year2024\Y2024D7Service;
use App\Service\Days\Year2024\Y2024D8Service;
use App\Service\Days\Year2024\Y2024D9Service;
use App\Service\Tools\FileOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbstractDayController extends AbstractController
{
    public array $dayClass;

    public function __construct()
    {
        $this->dayClass = [
            20231 => ['class' => Y2023D1Service::class, 'title' => 'Trebuchet?!'],
            20232 => ['class' => Y2023D2Service::class, 'title' => 'Cube Conundrum'],
            20233 => ['class' => Y2023D3Service::class, 'title' => 'Gear Ratios'],
            20234 => ['class' => Y2023D4Service::class, 'title' => 'Scratchcards'],
            20235 => ['class' => Y2023D5Service::class, 'title' => 'If You Give A Seed A Fertilizer'],
            20236 => ['class' => Y2023D6Service::class, 'title' => 'Wait For It'],
            20237 => ['class' => Y2023D7Service::class, 'title' => 'Camel Cards'],
            20238 => ['class' => Y2023D8Service::class, 'title' => 'Haunted Wasteland'],
            20239 => ['class' => Y2023D9Service::class, 'title' => 'Mirage Maintenance'],
            202310 => ['class' => Y2023D10Service::class, 'title' => 'Pipe Maze'],
            202311 => ['class' => Y2023D11Service::class, 'title' => 'Cosmic Expansion'],
            202312 => ['class' => Y2023D12Service::class, 'title' => 'Hot Springs'],
            202313 => ['class' => Y2023D13Service::class, 'title' => 'Point of Incidence'],
            202314 => ['class' => Y2023D14Service::class, 'title' => 'Parabolic Reflector Dish'],
            202315 => ['class' => Y2023D15Service::class, 'title' => 'Lens Library'],
            202316 => ['class' => Y2023D16Service::class, 'title' => 'The Floor Will Be Lava'],
            202317 => ['class' => Y2023D17Service::class, 'title' => 'Clumsy Crucible'],
            202318 => ['class' => Y2023D18Service::class, 'title' => 'Lavaduct Lagoon'],
            202319 => ['class' => Y2023D19Service::class, 'title' => 'Aplenty'],
            202320 => ['class' => Y2023D20Service::class, 'title' => 'Pulse Propagation'],
            202321 => ['class' => Y2023D21Service::class, 'title' => '???'],
            202322 => ['class' => Y2023D22Service::class, 'title' => '???'],
            202323 => ['class' => Y2023D23Service::class, 'title' => '???'],
            202324 => ['class' => Y2023D24Service::class, 'title' => '???'],
            202325 => ['class' => Y2023D25Service::class, 'title' => '???'],
            20241 => ['class' => Y2024D1Service::class, 'title' => '???'],
            20242 => ['class' => Y2024D2Service::class, 'title' => '???'],
            20243 => ['class' => Y2024D3Service::class, 'title' => '???'],
            20244 => ['class' => Y2024D4Service::class, 'title' => '???'],
            20245 => ['class' => Y2024D5Service::class, 'title' => '???'],
            20246 => ['class' => Y2024D6Service::class, 'title' => '???'],
            20247 => ['class' => Y2024D7Service::class, 'title' => '???'],
            20248 => ['class' => Y2024D8Service::class, 'title' => '???'],
            20249 => ['class' => Y2024D9Service::class, 'title' => '???'],
            202410 => ['class' => Y2024D10Service::class, 'title' => '???'],
            202411 => ['class' => Y2024D11Service::class, 'title' => '???'],
            202412 => ['class' => Y2024D12Service::class, 'title' => '???'],
            202413 => ['class' => Y2024D13Service::class, 'title' => '???'],
            202414 => ['class' => Y2024D14Service::class, 'title' => '???'],
            202415 => ['class' => Y2024D15Service::class, 'title' => '???'],
            202416 => ['class' => Y2024D16Service::class, 'title' => '???'],
            202417 => ['class' => Y2024D17Service::class, 'title' => '???'],
            202418 => ['class' => Y2024D18Service::class, 'title' => '???'],
            202419 => ['class' => Y2024D19Service::class, 'title' => '???'],
            202420 => ['class' => Y2024D20Service::class, 'title' => '???'],
            202421 => ['class' => Y2024D21Service::class, 'title' => '???'],
            202422 => ['class' => Y2024D22Service::class, 'title' => '???'],
            202423 => ['class' => Y2024D23Service::class, 'title' => '???'],
            202424 => ['class' => Y2024D24Service::class, 'title' => '???'],
            202425 => ['class' => Y2024D25Service::class, 'title' => '???']
        ];
    }

    public function renderDayPage(Request $request, FileOptions $fileOptions, int $year, int $day): Response
    {
        $index = $year.$day;
        if (!isset($this->dayClass[$index])) {
            return $this->redirectToRoute('app_year_days', ['year' => $year]);
        }
        $dayService = new $this->dayClass[$index]['class'];
        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $rows = $fileOptions->getDayInput($formData, $year, $day);

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
            'year' => $year,
            'day_title' => $this->dayClass[$index]['title'],
            'result' => $result,
            'form' => $form,
        ]);
    }
}
