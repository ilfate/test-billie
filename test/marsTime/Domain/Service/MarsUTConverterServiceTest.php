<?php declare(strict_types=1);

namespace marsTime\Dataprovider\Assortment;

use marsTime\Domain\Service\MarsUTConverterService;
use marsTime\Entity\JulianDateInMSD;
use marsTime\Entity\JulianDateInTerrestrialTime;
use PHPUnit\Framework\TestCase;

class MarsUTConverterServiceTest extends TestCase
{
    public function testConvertExampleDate()
    {
        $converter = new MarsUTConverterService();

        $result = $converter->convert(new JulianDateInTerrestrialTime(2458940.7855576854));

        $this->assertInstanceOf(JulianDateInMSD::class, $result);
        $this->assertEquals(51989.525547203746, $result->getDate());
    }
}