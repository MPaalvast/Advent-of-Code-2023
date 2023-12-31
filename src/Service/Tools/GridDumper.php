<?php

namespace App\Service\Tools;

class GridDumper
{
    public static function dumpGrid(array $grid, string $separator = ','): void
    {
        $dump = '';
        foreach ($grid as $row) {
            $dump .= implode($separator, $row) . "\n";
        }
        dump($dump);
    }
}