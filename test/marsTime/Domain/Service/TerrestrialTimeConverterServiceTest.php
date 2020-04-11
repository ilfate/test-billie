<?php declare(strict_types=1);

namespace marsTime\Dataprovider\Assortment;

use marsTime\Domain\Service\JulianDateConverterService;
use marsTime\Domain\Service\TerrestrialTimeConverterService;
use marsTime\Entity\JulianDate;
use marsTime\Entity\JulianDateInTerrestrialTime;
use marsTime\Entity\JulianDateInUTC;
use PHPUnit\Framework\TestCase;

class TerrestrialTimeConverterServiceTest extends TestCase
{
    public function testConvertExampleDate()
    {
        $julianDateConverterMock = $this->getMockBuilder(JulianDateConverterService::class)
            ->setMethods(['convertSecondsToJD'])
            ->getMock();
        $julianDateConverterMock->expects($this->exactly(2))
            ->method('convertSecondsToJD')
            ->willReturn(
                new JulianDate(0.00037249999999999995),
                new JulianDate(0.00042824074074074075)
            );
        $converter = new TerrestrialTimeConverterService(37, $julianDateConverterMock);

        $result = $converter->convertJDUTCtoJDTT(new JulianDateInUTC(2458940.7847569445));

        $this->assertInstanceOf(JulianDateInTerrestrialTime::class, $result);
        $this->assertEquals(2458940.7855576854, $result->getDate());
    }
}