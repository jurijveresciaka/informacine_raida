<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "Clock.php";

class AngleCalculator
{

    ///////////////////////////////////////////////
    //VARIABLES                                  //
    ///////////////////////////////////////////////

    private $clock;
    private $minutes_arrow_minutes_multiplicator;
    private $minutes_arrow_seconds_multiplicator;

    ///////////////////////////////////////////////
    //CONSTRUCTOR                                //
    ///////////////////////////////////////////////

    function __construct($clock)
    {
        $this->clock = $clock;

        $this->minutes_arrow_minutes_multiplicator = 6.0;
        $this->minutes_arrow_seconds_multiplicator = 0.1;

        $this->hours_arrow_hours_multiplicator = 30.0;
        $this->hours_arrow_minutes_multiplicator = 0.5;
        $this->hours_arrow_seconds_multiplicator = 30 / 3600;
    }

    ///////////////////////////////////////////////
    //CUSTOM GETTERS                             //
    ///////////////////////////////////////////////

    public function getMinutesArrowAngle()
    {
        $angle = ($this->clock->getMinutes() * $this->minutes_arrow_minutes_multiplicator);
        $angle += ($this->clock->getSeconds() * $this->minutes_arrow_seconds_multiplicator);

        return $angle;
    }

    public function getHoursArrowAngle()
    {
        $angle = ($this->clock->getHours12Format() * $this->hours_arrow_hours_multiplicator);
        $angle += ($this->clock->getMinutes() * $this->hours_arrow_minutes_multiplicator);
        $angle += ($this->clock->getSeconds() * $this->hours_arrow_seconds_multiplicator);

        return $angle;
    }

    public function getMinimumAngleBetweenClockArrowsFloat()
    {
        $angle = abs($this->getMinutesArrowAngle() - $this->getHoursArrowAngle());

        if ($angle >= 180.0) {
            $angle = 360.0 - $angle;
        }

        return $angle;
    }

    public function getMinimumAngleBetweenClockArrowsString()
    {
        $angle = strval($this->getMinimumAngleBetweenClockArrowsFloat() . "&deg;");

        return $angle;
    }

    public function getMaximumAngleBetweenClockArrowsFloat()
    {
        $angle = abs($this->getMinutesArrowAngle() - $this->getHoursArrowAngle());

        if ($angle < 180.0) {
            $angle = 360.0 - $angle;
        }

        return $angle;
    }

    public function getMaximumAngleBetweenClockArrowsString()
    {
        $angle = strval($this->getMaximumAngleBetweenClockArrowsFloat() . "&deg;");

        return $angle;
    }

    ///////////////////////////////////////////////
    //ACCESSORS                                  //
    ///////////////////////////////////////////////

    /**
     * @param mixed $clock
     */
    public function setClock($clock)
    {
        $this->clock = $clock;
    }

    /**
     * @return mixed
     */
    public function getClock()
    {
        return $this->clock;
    }
}