<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "TimeHelper.php";

class TimeHelperGetNaktinisLaikasTest extends PHPUnit_Framework_TestCase
{
    ///////////////////////////////////////////////
    //TYPES                                      //
    ///////////////////////////////////////////////

    /**
     * @dataProvider provideInvalidTypes
     */
    public function testTypesOfParameters($exception, $exception_message, $date_start, $date_end, $night_start, $night_end)
    {
        $this->time_helper = new TimeHelper();

        $this->setExpectedException($exception, $exception_message);
        $this->time_helper->getNaktinisLaikas($date_start, $date_end, $night_start, $night_end);
    }

    public function provideInvalidTypes()
    {
        $e = 'Exception';
        $m = 'wrong parameter';

        return array(
            array(
                $e,
                'date_start' . ' ' . $m,
                'Invalid',
                new DateTime(),
                new DateTime(),
                new DateTime()
            ),
            array(
                $e,
                'date_end' . ' ' . $m,
                new DateTime(),
                'Invalid',
                new DateTime(),
                new DateTime()
            ),
            array(
                $e,
                'night_start' . ' ' . $m,
                new DateTime(),
                new DateTime(),
                'Invalid',
                new DateTime()
            ),
            array(
                $e,
                'night_end' . ' ' . $m,
                new DateTime(),
                new DateTime(),
                new DateTime(),
                'Invalid'
            )
        );
    }

    ///////////////////////////////////////////////
    //VALUES                                     //
    ///////////////////////////////////////////////

    /**
     * @dataProvider provideInvalidValues
     */
    public function testValuesOfParameters(
        $exception,
        $exception_message,
        $date_start, $date_end,
        $night_start,
        $night_end
    )
    {
        $this->time_helper = new TimeHelper();

        $this->setExpectedException($exception, $exception_message);
        $this->time_helper->getNaktinisLaikas($date_start, $date_end, $night_start, $night_end);
    }

    public function provideInvalidValues()
    {
        $e = 'Exception';

        return array(
            array(
                $e,
                '!(date_start < date_end)',
                new DateTime('2013-12-02 00:00:00'), //bad
                new DateTime('2013-12-01 00:00:00'), //bad
                new DateTime('01:00:00'),
                new DateTime('02:00:00')
            ),
            array(
                $e,
                '!(date_start < date_end)',
                new DateTime('2013-12-02 00:00:00'), //bad
                new DateTime('2013-12-02 00:00:00'), //bad
                new DateTime('01:00:00'),
                new DateTime('02:00:00')
            ),
            array(
                $e,
                '!(night_start < night_end)',
                new DateTime('2013-12-01 00:00:00'),
                new DateTime('2013-12-02 00:00:00'),
                new DateTime('20:00:00'), //bad
                new DateTime('19:00:00') //bad
            ),
            array(
                $e,
                '!(night_start < night_end)',
                new DateTime('2013-12-01 00:00:00'),
                new DateTime('2013-12-02 00:00:00'),
                new DateTime('20:00:00'), //bad
                new DateTime('20:00:00') //bad
            )
        );
    }

    ///////////////////////////////////////////////
    //RETURN VALUE                               //
    ///////////////////////////////////////////////

    /**
     * @dataProvider provideValidInput
     */
    public function testReturnValue(
        $date_start,
        $date_end,
        $night_start,
        $night_end,
        $expected_minutes
    )
    {
        $this->time_helper = new TimeHelper();
        $this->assertEquals(
            $expected_minutes,
            $this->time_helper->getNaktinisLaikas(
                $date_start,
                $date_end,
                $night_start,
                $night_end
            )
        );
    }

    public function provideValidInput()
    {
        return array(
            array(
                new DateTime('2013-12-01 23:59:00'),
                new DateTime('2013-12-02 00:01:00'),
                new DateTime('00:00:00'),
                new DateTime('00:01:00'),
                1
            ),
            array(
                new DateTime('2013-12-01 23:59:00'),
                new DateTime('2013-12-03 00:01:00'),
                new DateTime('00:00:00'),
                new DateTime('00:01:00'),
                2
            ),
            array(
                new DateTime('2013-12-01 23:59:00'),
                new DateTime('2013-12-05 00:01:00'),
                new DateTime('00:00:00'),
                new DateTime('00:01:00'),
                4
            ),
            array(
                new DateTime('2013-12-01 00:00:00'),
                new DateTime('2013-12-01 00:01:00'),
                new DateTime('00:00:00'),
                new DateTime('00:01:00'),
                1
            ),
            array(
                new DateTime('2013-12-01 00:00:00'),
                new DateTime('2013-12-01 23:59:00'),
                new DateTime('00:00:00'),
                new DateTime('05:30:00'),
                330
            ),
            array(
                new DateTime('2013-12-01 00:00:00'),
                new DateTime('2013-12-02 00:01:00'),
                new DateTime('00:00:00'),
                new DateTime('00:01:00'),
                2
            ),
            array(
                new DateTime('2013-12-01 00:00:00'),
                new DateTime('2013-12-01 01:30:00'),
                new DateTime('01:00:00'),
                new DateTime('02:00:00'),
                30
            ),
            array(
                new DateTime('2013-12-01 00:00:00'),
                new DateTime('2013-12-10 00:00:00'),
                new DateTime('00:00:00'),
                new DateTime('05:00:00'),
                2700
            )
        );
    }
}