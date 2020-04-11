<?php declare(strict_types=1);

namespace marsTime\Dataprovider\Assortment;

use marsTime\Application\InputValidator;
use marsTime\Exception\InputError;
use PHPUnit\Framework\TestCase;

class InputValidatorTest extends TestCase
{
    public function testWrongInputValue()
    {
        $validator = new InputValidator();

        $this->expectException(InputError::class);

        $validator->validate("123q123");
    }

    public function testPositiveInputCase()
    {
        $validator = new InputValidator();

        $this->assertTrue($validator->validate("123123"));
    }
}