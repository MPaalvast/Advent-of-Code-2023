<?php

namespace App\Service\Tools;

use App\Entity\GameDay;
use App\Entity\Year;
use App\Repository\GameDayInputRepository;
use App\Repository\GameDayRepository;

readonly class DayInputOptions
{
    public function __construct(
        private GameDayInputRepository $gameDayInputRepository,
    ) {
    }

    public function getDayInput($formData, Year $year, GameDay $gameDay): array|false
    {
        // @TODO: remove file directory
        if ($formData['input_type'] !== 'preview') {
            return preg_split("/\r\n|\n|\r/", $formData['input'] ?? '');
        }

        if (
            null === ($dayInputEntity = $this->gameDayInputRepository->findOneBy(['gameDay' => $gameDay, 'dayPart' => $formData['day_part'] === 1 ? 1 : 2]))
        ) {
            return [];
        }

        return preg_split("/\r\n|\n|\r/", $dayInputEntity?->getInput() ?? '');
    }
}
