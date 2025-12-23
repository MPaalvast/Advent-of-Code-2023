<?php

namespace App\Controller\Api;

use App\Entity\GameDayInput;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class ExampleInputController extends AbstractController
{
    #[Route('/api/exampleinput/{input}', name: 'api_exampleinput_show')]
    public function show(GameDayInput $input): JsonResponse
    {
        return $this->json([
            'value' => $input->getInput()
        ]);
    }

}