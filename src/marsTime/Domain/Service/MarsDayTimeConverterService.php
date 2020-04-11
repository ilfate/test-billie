<?php
declare(strict_types=1);

namespace marsTime\Domain\Service;

use marsTime\Entity\JulianDateInMSD;

class MarsDayTimeConverterService
{
    public function convert(JulianDateInMSD $julianDateInMSD): string
    {
        $date = floor($julianDateInMSD->getDate());
        $decimalPart = $julianDateInMSD->getDate() - $date;
        $hours = floor($decimalPart * 24);
        $minutes = floor($decimalPart * 24 * 60 - ($hours * 60));
        $seconds = floor($decimalPart * 24 * 60 * 60 - ($hours * 60 * 60) - ($minutes * 60));
        return sprintf("%s:%s:%s", $hours, $minutes, $seconds);
    }
}