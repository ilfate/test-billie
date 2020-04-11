<?php
declare(strict_types=1);

namespace marsTime\Domain\Service;

use marsTime\Entity\JulianDate;
use marsTime\Entity\JulianDateInMSD;
use marsTime\Entity\JulianDateInTerrestrialTime;

class MarsUTConverterService
{
    public function convert(JulianDateInTerrestrialTime $dateInTerrestrialTime): JulianDateInMSD
    {
        $newDate = $dateInTerrestrialTime->add(new JulianDate(-2405522.0028779));

        return new JulianDateInMSD($newDate->getDate() / 1.0274912517);
    }
}