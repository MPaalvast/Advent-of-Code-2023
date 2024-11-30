<?php

namespace App\Service\Tools;

class FileOptions
{

    public function loadFile(int $year, string $filename)
    {
        return fopen('../files/' . $year . '/' . $filename, 'rb');
    }

    public function getAllLines($file_handle): \Generator
    {
        while (!feof($file_handle)) {
            yield str_replace(PHP_EOL, '', fgets($file_handle));
        }
    }

    public function getDayInput($formData, int $year, int $day): array|false|\Generator
    {
        if ($formData['input_type'] !== 'preview') {
            $rows = preg_split("/\r\n|\n|\r/", $formData['input'] ?? '');
        } else {
            $part = $formData['day_part'] === 1 ? 1 : 2;
            $file = $this->loadFile($year, '/Day' . $day . '/' . $part . '.txt');
            $rows = $this->getAllLines($file);
        }

        return $rows;
    }
}
