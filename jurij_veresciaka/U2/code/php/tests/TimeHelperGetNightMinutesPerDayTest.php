<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "TimeHelper.php";

class TimeHelperGetNightMinutesPerDayTest extends PHPUnit_Framework_TestCase
{
    ///////////////////////////////////////////////
    //TYPES                                      //
    ///////////////////////////////////////////////

    /**
     * @dataProvider provideInvalidTypes
     */
    public function testTypesOfParameters($exception, $exception_message, $day_start, $day_end, $night_start, $night_end)
    {
        $this->time_helper = new TimeHelper();

        $this->setExpectedException($exception, $exception_message);
        $this->time_helper->getNightMinutesPerDay($day_start, $day_end, $night_start, $night_end);
    }

    public function provideInvalidTypes()
    {
        $e = 'Exception';
        $m = 'wrong parameter';

        return array(
            array(
                $e,
                'day_start' . ' ' . $m,
                'Invalid',
                new DateTime(),
                new DateTime(),
                new DateTime()
            ),
            array(
                $e,
                'day_end' . ' ' . $m,
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
        $day_start, $day_end,
        $night_start,
        $night_end
    )
    {
        $this->time_helper = new TimeHelper();

        $this->setExpectedException($exception, $exception_message);
        $this->time_helper->getNightMinutesPerDay($day_start, $day_end, $night_start, $night_end);
    }

    public function provideInvalidValues()
    {
        $e = 'Exception';

        return array(
            array(
                $e,
                '!(day_start <= day_end)',
                new DateTime('20:00:00'), //bad
                new DateTime('19:00:00'), //bad
                new DateTime('01:00:00'),
                new DateTime('02:00:00')
            ),
            array(
                $e,
                '!(night_start < night_end)',
                new DateTime('01:00:00'),
                new DateTime('02:00:00'),
                new DateTime('20:00:00'), //bad
                new DateTime('19:00:00') //bad
            ),
            array(
                $e,
                '!(night_start < night_end)',
                new DateTime('01:00:00'),
                new DateTime('02:00:00'),
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
        $day_start,
        $day_end,
        $night_start,
        $night_end,
        $expected_minutes
    )
    {
        $this->time_helper = new TimeHelper();
        $this->assertEquals(
            $expected_minutes,
            $this->time_helper->getNightMinutesPerDay(
                $day_start,
                $day_end,
                $night_start,
                $night_end
            )
        );
    }

    public function provideValidInput()
    {
        return array(
            // day   1/--/2
            // night       3/--/4
            array(
                new DateTime('01:00:00'),
                new DateTime('02:00:00'),
                new DateTime('03:00:00'),
                new DateTime('04:00:00'),
                0
            ),
            // day   1/--/2
            // night      2/--/4
            array(
                new DateTime('01:00:00'),
                new DateTime('02:00:00'),
                new DateTime('02:00:00'),
                new DateTime('04:00:00'),
                0
            ),
            // day         3/--/4
            // night 1/--/2
            array(
                new DateTime('03:00:00'),
                new DateTime('04:00:00'),
                new DateTime('01:00:00'),
                new DateTime('02:00:00'),
                0
            ),
            // day        2/--/4
            // night 1/--/2
            array(
                new DateTime('02:00:00'),
                new DateTime('04:00:00'),
                new DateTime('01:00:00'),
                new DateTime('02:00:00'),
                0
            ),
            // day   1/-----/4
            // night 1/-----/4
            array(
                new DateTime('01:00:00'),
                new DateTime('04:00:00'),
                new DateTime('01:00:00'),
                new DateTime('04:00:00'),
                180
            ),
            // day   1/-----/4
            // night  2/--/3
            array(
                new DateTime('01:00:00'),
                new DateTime('04:00:00'),
                new DateTime('02:00:00'),
                new DateTime('03:00:00'),
                60
            ),
            // day   1/-----/7
            // night  3/--/5
            array(
                new DateTime('01:00:00'),
                new DateTime('07:00:00'),
                new DateTime('03:00:00'),
                new DateTime('05:00:00'),
                120
            ),
            // day   1/--------/4
            // night  2.30/--/3
            array(
                new DateTime('01:00:00'),
                new DateTime('04:00:00'),
                new DateTime('02:30:00'),
                new DateTime('03:00:00'),
                30
            ),
            // day     2/--/3
            // night 1/-----/4
            array(
                new DateTime('02:00:00'),
                new DateTime('03:00:00'),
                new DateTime('01:00:00'),
                new DateTime('04:00:00'),
                60
            ),
            // day     3/--/5
            // night 1/-----/7
            array(
                new DateTime('03:00:00'),
                new DateTime('05:00:00'),
                new DateTime('01:00:00'),
                new DateTime('07:00:00'),
                120
            ),
            // day     2.30/--/3
            // night 1/--------/4
            array(
                new DateTime('02:30:00'),
                new DateTime('03:00:00'),
                new DateTime('01:00:00'),
                new DateTime('04:00:00'),
                30
            ),
            // day    1/-----/3
            // night     2/-----/4
            array(
                new DateTime('01:00:00'),
                new DateTime('03:00:00'),
                new DateTime('02:00:00'),
                new DateTime('04:00:00'),
                60
            ),
            // day    1/-----/5
            // night     3/-----/7
            array(
                new DateTime('01:00:00'),
                new DateTime('05:00:00'),
                new DateTime('03:00:00'),
                new DateTime('07:00:00'),
                120
            ),
            // day    1/--------/3
            // night     2.30/-----/4
            array(
                new DateTime('01:00:00'),
                new DateTime('03:00:00'),
                new DateTime('02:30:00'),
                new DateTime('04:00:00'),
                30
            ),
            // day    1/-----/3
            // night  1/--------/4
            array(
                new DateTime('01:00:00'),
                new DateTime('03:00:00'),
                new DateTime('01:00:00'),
                new DateTime('04:00:00'),
                120
            ),
            // day    1/-----/3
            // night  1/--------/5
            array(
                new DateTime('01:00:00'),
                new DateTime('03:00:00'),
                new DateTime('01:00:00'),
                new DateTime('05:00:00'),
                120
            ),
            // day    1/-----/3.30
            // night  1/--------/4
            array(
                new DateTime('01:00:00'),
                new DateTime('03:30:00'),
                new DateTime('01:00:00'),
                new DateTime('04:00:00'),
                150
            ),
            // day       2/-----/4
            // night  1/-----/3
            array(
                new DateTime('02:00:00'),
                new DateTime('04:00:00'),
                new DateTime('01:00:00'),
                new DateTime('03:00:00'),
                60
            ),
            // day       3/-----/7
            // night  1/-----/5
            array(
                new DateTime('03:00:00'),
                new DateTime('07:00:00'),
                new DateTime('01:00:00'),
                new DateTime('05:00:00'),
                120
            ),
            // day       2.30/-----/4
            // night  1/--------/3
            array(
                new DateTime('02:30:00'),
                new DateTime('04:00:00'),
                new DateTime('01:00:00'),
                new DateTime('03:00:00'),
                30
            ),
            // day       2/-----/4
            // night  1/--------/4
            array(
                new DateTime('02:00:00'),
                new DateTime('04:00:00'),
                new DateTime('01:00:00'),
                new DateTime('04:00:00'),
                120
            ),
            // day       3/-----/7
            // night  1/--------/7
            array(
                new DateTime('03:00:00'),
                new DateTime('07:00:00'),
                new DateTime('01:00:00'),
                new DateTime('07:00:00'),
                240
            ),
            // day       2.30/-----/4
            // night  1/-----------/4
            array(
                new DateTime('02:30:00'),
                new DateTime('04:00:00'),
                new DateTime('01:00:00'),
                new DateTime('04:00:00'),
                90
            ),
            //custom
            array(
                new DateTime('2013-12-01 00:00:00'),
                new DateTime('2013-12-01 01:30:00'),
                new DateTime('01:00:00'),
                new DateTime('02:00:00'),
                30
            ),
            array(
                new DateTime('2013-12-01 00:00:00'),
                new DateTime('2013-12-02 00:01:00'),
                new DateTime('00:00:00'),
                new DateTime('00:01:00'),
                1
            ),
        );
    }
}