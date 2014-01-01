<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "Clock.php";

class ClockTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForConstructor
     */
    public function testConstructor($input_time, $expected_hours, $expected_hours_12_format, $expected_minutes, $expected_seconds)
    {
        $clock = new Clock($input_time);
        $this->assertEquals($expected_hours, $clock->getHours());
        $this->assertEquals($expected_hours_12_format, $clock->getHours12Format());
        $this->assertEquals($expected_minutes, $clock->getMinutes());
        $this->assertEquals($expected_seconds, $clock->getSeconds());
    }

    /**
     * @dataProvider providerForGetTime
     */
    public function testGetTime($input_time, $expected_time)
    {
        $clock = new Clock($input_time);
        $this->assertEquals($expected_time, $clock->getTime());
    }

    public function providerForConstructor()
    {
        return array(
            array("0:00:00", 0, 0, 0, 0),
            array("11:22:33", 11, 11, 22, 33),
            array("18:00:00", 18, 6, 0, 0)
        );
    }

    public function providerForGetTime()
    {
        return array(
            array("00:00:00", "00:00:00"),
            array("01:01:01", "01:01:01")
        );
    }
}
