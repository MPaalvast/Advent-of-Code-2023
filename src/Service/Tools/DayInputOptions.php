<?php

namespace App\Service\Tools;

use App\Entity\Year;
use App\Repository\GameDayInputRepository;
use App\Repository\GameDayRepository;

readonly class DayInputOptions
{
    public function __construct(
        private GameDayInputRepository $gameDayInputRepository,
        private GameDayRepository      $gameDayRepository,
    ) {
    }

    public function getDayInput($formData, Year $year, int $day): array|false
    {
        // @TODO: remove file directory
        if ($formData['input_type'] !== 'preview') {
            return preg_split("/\r\n|\n|\r/", $formData['input'] ?? '');
        }

        if (
            null === ($gameDayEntity = $this->gameDayRepository->findOneBy(['year' => $year, 'day' => $day])) ||
            null === ($dayInputEntity = $this->gameDayInputRepository->findOneBy(['gameDay' => $gameDayEntity, 'dayPart' => $formData['day_part'] === 1 ? 1 : 2]))
        ) {
            return [];
        }

        return preg_split("/\r\n|\n|\r/", $dayInputEntity?->getInput() ?? '');
    }
}
