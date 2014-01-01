<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "TimeValidator.php";

class TimeValidatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerValid
     */
    public function testValid($time)
    {
        $time_validator = new TimeValidator();
        $this->assertTrue($time_validator->isTimeValid($time));
    }

    /**
     * @dataProvider providerInvalid
     */
    public function testInalid($time)
    {
        $time_validator = new TimeValidator();
        $this->assertFalse($time_validator->isTimeValid($time));
    }

    public function providerValid()
    {
        return array(
            // test hours
            array("01:00:00"),
            array("1:00:00"),
            array("02:00:00"),
            array("2:00:00"),
            array("13:00:00"),
            // test minutes
            array("00:00:00"),
            array("00:01:00"),
            array("00:59:00"),
            // test seconds
            array("00:00:00"),
            array("00:00:01"),
            array("00:00:59"),
            // test hours and minutes and seconds
            array("23:59:59"),
            array("01:01:01")
        );
    }

    public function providerInvalid()
    {
        return array(
            // test hours
            array(":00:00"),
            array("24:00:00"),
            array("25:00:00"),
            // test minutes
            array("00::00"),
            array("00:0:00"),
            array("00:60:00"),
            array("00:61:00"),
            // test seconds
            array("00:00:"),
            array("00:00:0"),
            array("00:00:60"),
            array("00:00:61"),
            // test hours and minutes and seconds
            array("::"),
            array("00:0:0")
        );
    }
}