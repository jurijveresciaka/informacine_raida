<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "TimeHelper.php";

class TimeHelperGetMinutesFromTimeTest extends PHPUnit_Framework_TestCase {

    ///////////////////////////////////////////////
    //TYPE                                       //
    ///////////////////////////////////////////////

    /**
     * @dataProvider provideTypes
     */
    public function testTypesOfParameters($exception, $exception_message, $time)
    {
        $this->time_helper = new TimeHelper();

        $this->setExpectedException($exception, $exception_message);
        $this->time_helper->getMinutesFromTime($time);
    }

    public function provideTypes()
    {
        $e = 'Exception';
        $m = 'time wrong parameter';

        return array(
            array($e, $m, 'Invalid')
        );
    }

    ///////////////////////////////////////////////
    //RETURN VALUE                               //
    ///////////////////////////////////////////////

    /**
     * @dataProvider provideValidInput
     */
    public function testReturnValue($input, $expected_minutes)
    {
        $this->time_helper = new TimeHelper();
        $this->assertEquals($expected_minutes, $this->time_helper->getMinutesFromTime($input));
    }

    public function provideValidInput()
    {
        return array(
            array(new DateTime('00:00:00'), 0),
            array(new DateTime('00:00:30'), 0),
            array(new DateTime('00:01:00'), 1),
            array(new DateTime('00:30:00'), 30),
            array(new DateTime('00:59:00'), 59),
            array(new DateTime('01:00:00'), 60),
            array(new DateTime('18:00:00'), 1080),
            array(new DateTime('23:00:00'), 1380),
            array(new DateTime('01:59:00'), 119)
        );
    }
}