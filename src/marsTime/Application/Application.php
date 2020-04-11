<?php declare(strict_types=1);

namespace marsTime\Application;

use marsTime\Domain\Service\JulianDateConverterService;
use marsTime\Domain\Service\MarsDayTimeConverterService;
use marsTime\Domain\Service\MarsUTConverterService;
use marsTime\Domain\Service\TerrestrialTimeConverterService;
use marsTime\Exception\InputError;
use marsTime\Exception\System64BitRequired;

/**
 * The goal of this application is to work as an API enpoint
 *
 * Class Application
 * @package marsTime\Application
 */
class Application
{

    /**
     * @var InputValidator
     */
    private $inputValidator;
    /**
     * @var TerrestrialTimeConverterService
     */
    private $terrestrialTimeConverterService;
    /**
     * @var MarsUTConverterService
     */
    private $marsUTConverterService;
    /**
     * @var JulianDateConverterService
     */
    private $julianDateConverterService;
    /**
     * @var MarsDayTimeConverterService
     */
    private $marsDayTimeConverterService;
    /**
     * @var HeaderSetter
     */
    private HeaderSetter $headerSetter;

    public function __construct(
        TerrestrialTimeConverterService $terrestrialTimeConverterService,
        MarsUTConverterService $marsUTConverterService,
        JulianDateConverterService $julianDateConverterService,
        MarsDayTimeConverterService $marsDayTimeConverterService,
        InputValidator $inputValidator,
        HeaderSetter $headerSetter
    ) {
        $this->terrestrialTimeConverterService = $terrestrialTimeConverterService;
        $this->marsUTConverterService = $marsUTConverterService;
        $this->julianDateConverterService = $julianDateConverterService;
        $this->marsDayTimeConverterService = $marsDayTimeConverterService;
        $this->inputValidator = $inputValidator;
        $this->headerSetter = $headerSetter;
    }

    public function run() {
        try {
            $this->checkSystemRequirements();

            if (!empty($_REQUEST['time'])) {
                $input = $_REQUEST['time'];
                $this->inputValidator->validate($input);
            } else {
                $input = time();
            }
            $dateJDUTC = $this->julianDateConverterService->convertUTCToJD((int)$input);
            $dateJDTT = $this->terrestrialTimeConverterService->convertJDUTCtoJDTT($dateJDUTC);
            $dateMars = $this->marsUTConverterService->convert($dateJDTT);
            $timeMars = $this->marsDayTimeConverterService->convert($dateMars);
            echo json_encode([
                'status' => 'OK',
                'MSD' => $dateMars->__toString(),
                'MTC' => $timeMars
            ]);
        } catch (InputError $exception) {
            $this->headerSetter->setHeader('HTTP/1.1 400 Bad Request');
            echo json_encode(['status' => 'error', 'message' => $exception->getMessage()]);
        } catch (\Exception $exception) {
            $this->headerSetter->setHeader('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    /**
     * @throws System64BitRequired
     */
    protected function checkSystemRequirements()
    {
        if (PHP_INT_SIZE < 8) {
            throw new System64BitRequired('Application can only execute on 64 bit systems');
        }
    }
}