<?php declare(strict_types=1);

namespace marsTime\Dataprovider\Assortment;

use marsTime\Domain\Service\MarsDayTimeConverterService;
use marsTime\Entity\JulianDateInMSD;
use PHPUnit\Framework\TestCase;

class MarsDayTimeConverterServiceTest extends TestCase
{
    public function testConvertExampleDate()
    {
        $converter = new MarsDayTimeConverterService();

        $result = $converter->convert(new JulianDateInMSD(51989.525547203746));

        $this->assertIsString($result);
        $this->assertEquals("12:36:47", $result);
    }
}