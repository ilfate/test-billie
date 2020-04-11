<?php declare(strict_types=1);

namespace marsTime\Dataprovider\Assortment;

use marsTime\Domain\Service\JulianDateConverterService;
use marsTime\Entity\JulianDate;
use marsTime\Entity\JulianDateInUTC;
use PHPUnit\Framework\TestCase;

class JulianDateConverterServiceTest extends TestCase
{
    public function testConvertExampleDate()
    {
        $converter = new JulianDateConverterService();

        $result = $converter->convertUTCToJD(1585723803);

        $this->assertInstanceOf(JulianDateInUTC::class, $result);
        $this->assertEquals(2458940.7847569445, $result->getDate());
    }

    public function testConvertSecondsRange()
    {
        $converter = new JulianDateConverterService();

        $result = $converter->convertSecondsToJD(37);

        $this->assertInstanceOf(JulianDate::class, $result);
        $this->assertEquals(0.00042824074074074075, $result->getDate());
    }
}