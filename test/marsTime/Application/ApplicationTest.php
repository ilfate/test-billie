<?php declare(strict_types=1);

namespace marsTime\Dataprovider\Assortment;

use marsTime\Application\Application;
use marsTime\Application\HeaderSetter;
use marsTime\Application\InputValidator;
use marsTime\Domain\Service\JulianDateConverterService;
use marsTime\Domain\Service\MarsDayTimeConverterService;
use marsTime\Domain\Service\MarsUTConverterService;
use marsTime\Domain\Service\TerrestrialTimeConverterService;
use marsTime\Entity\JulianDateInMSD;
use marsTime\Entity\JulianDateInTerrestrialTime;
use marsTime\Entity\JulianDateInUTC;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testRun()
    {
        $input = 1585723803;
        $terrestrialTimeConverterServiceMock = $this->getMockBuilder(TerrestrialTimeConverterService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $terrestrialTimeConverterServiceMock->expects($this->once())
            ->method('convertJDUTCtoJDTT')
            ->willReturn(new JulianDateInTerrestrialTime(123.123));

        $marsUTConverterServiceMock = $this->getMockBuilder(MarsUTConverterService::class)
            ->getMock();
        $marsUTConverterServiceMock->expects($this->once())
            ->method('convert')
            ->willReturn(new JulianDateInMSD(51989.525547204));

        $julianDateConverterServiceMock = $this->getMockBuilder(JulianDateConverterService::class)
            ->getMock();
        $julianDateConverterServiceMock->expects($this->once())
            ->method('convertUTCToJD')
            ->willReturn(new JulianDateInUTC(123.123));

        $marsDayTimeConverterServiceMock = $this->getMockBuilder(MarsDayTimeConverterService::class)
            ->getMock();
        $marsDayTimeConverterServiceMock->expects($this->once())
            ->method('convert')
            ->willReturn('12:36:47');

        $inputValidatorMock = $this->getMockBuilder(InputValidator::class)
            ->getMock();
        $inputValidatorMock->expects($this->once())
            ->method('validate')->with($this->equalTo($input));

        $headerSetterMock = $this->getMockBuilder(HeaderSetter::class)
            ->getMock();
        $app = new Application(
            $terrestrialTimeConverterServiceMock,
            $marsUTConverterServiceMock,
            $julianDateConverterServiceMock,
            $marsDayTimeConverterServiceMock,
            $inputValidatorMock,
            $headerSetterMock
        );
        $_REQUEST['time'] = (string) $input;
        ob_start();
        $app->run();
        $responce = ob_get_clean();
        $this->assertIsString($responce);
        $this->assertEquals("{\"status\":\"OK\",\"MSD\":\"51989.525547204\",\"MTC\":\"12:36:47\"}", $responce);
    }
}