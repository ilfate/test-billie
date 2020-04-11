<?php
declare(strict_types=1);

namespace marsTime\Domain\Service;

use marsTime\Entity\JulianDate;
use marsTime\Entity\JulianDateInUTC;

class JulianDateConverterService
{
    /**
     * @param int $time
     * @return JulianDateInUTC
     */
    public function convertSecondsToJD($time): JulianDate
    {
        $jd = $time / 86400;
        return new JulianDate($jd);
    }

    /**
     * @param int $time
     * @return JulianDateInUTC
     */
    public function convertUTCToJD(int $time): JulianDateInUTC
    {
        $jd = $time / 86400.0 + 2440587.5;
        return new JulianDateInUTC($jd);
    }
}