<?php

namespace App\Service\Tools;


readonly class DayInputOptions
{
    public function getDayInput($formData): array|false
    {
        return preg_split("/\r\n|\n|\r/", $formData['input'] ?? '');
    }
}
