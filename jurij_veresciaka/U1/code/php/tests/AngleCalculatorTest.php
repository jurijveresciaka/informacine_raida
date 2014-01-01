<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "Clock.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "AngleCalculator.php";

class AngleCalculatorTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForGetMinutesArrowAngle
     */
    public function testGetMinutesArrowAngle($input_time, $expected_minutes_arrow_angle)
    {
        $clock = new Clock($input_time);
        $angle_calculator = new AngleCalculator($clock);
        $this->assertEquals($expected_minutes_arrow_angle, $angle_calculator->getMinutesArrowAngle());
    }

    /**
     * @dataProvider providerForGetHoursArrowAngle
     */
    public function testGetHoursArrowAngle($input_time, $expected_hours_arrow_angle)
    {
        $clock = new Clock($input_time);
        $angle_calculator = new AngleCalculator($clock);
        $this->assertEquals($expected_hours_arrow_angle, $angle_calculator->getHoursArrowAngle());
    }

    /**
     * @dataProvider providerForGetMinimumAngleBetweenClockArrowsFloat
     */
    public function testGetMinimumAngleBetweenClockArrowsFloat($input_time, $expected_minimum_angle_between_clock_arrows)
    {
        $clock = new Clock($input_time);
        $angle_calculator = new AngleCalculator($clock);
        $this->assertEquals($expected_minimum_angle_between_clock_arrows, $angle_calculator->getMinimumAngleBetweenClockArrowsFloat());
    }

    /**
     * @dataProvider providerForGetMinimumAngleBetweenClockArrowString
     */
    public function testGetMinimumAngleBetweenClockArrowsString($input_time, $expected_minimum_angle_between_clock_arrows)
    {
        $clock = new Clock($input_time);
        $angle_calculator = new AngleCalculator($clock);
        $this->assertEquals($expected_minimum_angle_between_clock_arrows, $angle_calculator->getMinimumAngleBetweenClockArrowsString());
    }

    /**
     * @dataProvider providerForGetMaximumAngleBetweenClockArrowsFloat
     */
    public function testGetMaximumAngleBetweenClockArrowsFloat($input_time, $expected_maximum_angle_between_clock_arrows)
    {
        $clock = new Clock($input_time);
        $angle_calculator = new AngleCalculator($clock);
        $this->assertEquals($expected_maximum_angle_between_clock_arrows, $angle_calculator->getMaximumAngleBetweenClockArrowsFloat());
    }

    /**
     * @dataProvider providerForGetMaximumAngleBetweenClockArrowString
     */
    public function testGetMaximumAngleBetweenClockArrowsString($input_time, $expected_maximum_angle_between_clock_arrows)
    {
        $clock = new Clock($input_time);
        $angle_calculator = new AngleCalculator($clock);
        $this->assertEquals($expected_maximum_angle_between_clock_arrows, $angle_calculator->getMaximumAngleBetweenClockArrowsString());
    }

    public function providerForGetMinutesArrowAngle()
    {
        return array(
            // test minutes
            array("0:00:00", 0.0),
            array("0:10:00", 60.0),
            array("0:30:00", 180.0),
            // test seconds
            array("0:00:15", 1.5),
            array("0:00:30", 3.0),
            array("0:00:45", 4.5),
            // test minutes and seconds
            array("0:10:15", 61.5),
            array("0:30:30", 183.0),
            array("0:50:45", 304.5)
        );
    }

    public function providerForGetHoursArrowAngle()
    {
        return array(
            // test hours
            array("01:00:00", 30.0),
            array("03:00:00", 90.0),
            array("05:00:00", 150.0),
            array("07:00:00", 210.0),
            array("09:00:00", 270.0),
            array("11:00:00", 330.0),
            // test minutes
            array("00:10:00", 5.0),
            array("00:30:00", 15.0),
            // test seconds
            array("00:00:15", 0.125),
            array("00:00:30", 0.25),
            array("00:00:45", 0.375),
            // test hours and minutes
            array("01:10:15", 35.125),
            array("03:30:30", 105.25),
            array("05:50:45", 175.375)
        );
    }

    public function providerForGetMinimumAngleBetweenClockArrowsFloat()
    {
        return array(
            // test hours
            array("01:00:00", 30.0),
            array("03:00:00", 90.0),
            // test minutes
            array("00:30:00", 165.0),
            array("00:45:00", 112.5),
            // test seconds
            array("00:00:30", 2.75),
            // test hours and minutes
            array("11:30:00", 165.0),
            array("11:15:00", 112.5)
        );
    }

    public function providerForGetMinimumAngleBetweenClockArrowString()
    {
        return array(
            // test hours
            array("01:00:00", "30&deg;"),
            array("03:00:00", "90&deg;"),
            // test minutes
            array("00:30:00", "165&deg;"),
            array("00:45:00", "112.5&deg;"),
            // test seconds
            array("00:00:30", "2.75&deg;"),
            // test hours and minutes
            array("11:30:00", "165&deg;"),
            array("11:15:00", "112.5&deg;")
        );
    }

    public function providerForGetMaximumAngleBetweenClockArrowsFloat()
    {
        return array(
            // test hours
            array("01:00:00", 330.0),
            array("03:00:00", 270.0),
            // test minutes
            array("00:30:00", 195.0),
            array("00:45:00", 247.5),
            // test seconds
            array("00:00:30", 357.25),
            // test hours and minutes
            array("11:30:00", 195.0),
            array("11:15:00", 247.5)
        );
    }

    public function providerForGetMaximumAngleBetweenClockArrowString()
    {
        return array(
            // test hours
            array("01:00:00", "330&deg;"),
            array("03:00:00", "270&deg;"),
            // test minutes
            array("00:30:00", "195&deg;"),
            array("00:45:00", "247.5&deg;"),
            // test seconds
            array("00:00:30", "357.25&deg;"),
            // test hours and minutes
            array("11:30:00", "195&deg;"),
            array("11:15:00", "247.5&deg;")
        );
    }
}
