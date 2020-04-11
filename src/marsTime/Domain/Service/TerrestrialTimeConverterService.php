<?php
declare(strict_types=1);

namespace marsTime\Domain\Service;

use marsTime\Entity\JulianDateInTerrestrialTime;
use marsTime\Entity\JulianDateInUTC;

class TerrestrialTimeConverterService
{
    /**
     * @var JulianDateConverterService
     */
    private $julianDateConverterService;

    private $leapSecondsValue;

    public function __construct(int $leapSecondsValue, JulianDateConverterService $julianDateConverterService)
    {
        $this->leapSecondsValue = $leapSecondsValue;
        $this->julianDateConverterService = $julianDateConverterService;
    }

    /**
     * @param JulianDateInUTC $dateInUTC
     * @return JulianDateInTerrestrialTime
     */
    public function convertJDUTCtoJDTT(JulianDateInUTC $dateInUTC): JulianDateInTerrestrialTime
    {
        $newDate = $dateInUTC->add( $this->julianDateConverterService->convertSecondsToJD(32.184));
        $newDate = $newDate->add( $this->julianDateConverterService->convertSecondsToJD((float) $this->leapSecondsValue));

        return new JulianDateInTerrestrialTime($newDate->getDate());
    }
}