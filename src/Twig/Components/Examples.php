<?php

namespace App\Twig\Components;

use App\Entity\GameDay;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Examples
{
//    use DefaultActionTrait;

//    #[LiveProp(writable: true)]
//    public int $partNr = 1;

//    #[LiveProp]
    public ?GameDay $gameDay = null;

    public function getExamples(): array
    {
        $output = [];
        foreach ($this->gameDay->getGameDayInputs() as $gameDayInput) {
            $partTitle = $gameDayInput->getDayPart()?->getTitle();
            if (!isset($output[$partTitle])) {
                $output[$partTitle] = [];
            }
            $output[$partTitle][] = $gameDayInput;
        }

        return $output;
    }
}