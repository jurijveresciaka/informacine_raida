<?php

class Clock
{

    ///////////////////////////////////////////////
    //VARIABLES                                  //
    ///////////////////////////////////////////////

    private $hours;
    private $minutes;
    private $seconds;

    ///////////////////////////////////////////////
    //CONSTRUCTOR                                //
    ///////////////////////////////////////////////

    function __construct($time)
    {
        $time_array = explode(":", $time);
        $this->setHours((int)$time_array[0]);
        $this->setMinutes((int)$time_array[1]);
        $this->setSeconds((int)$time_array[2]);
    }

    ///////////////////////////////////////////////
    //HELPERS                                    //
    ///////////////////////////////////////////////

    private function expand_time_string($time)
    {
        if (strlen((string)$time) < 2) {
            $time = "0" . $time;
        }

        return $time;
    }

    ///////////////////////////////////////////////
    //CUTSOM GETTERS                             //
    ///////////////////////////////////////////////

    public function getTime()
    {
        $hours = $this->expand_time_string($this->getHours());
        $minutes = $this->expand_time_string($this->getMinutes());
        $seconds = $this->expand_time_string($this->getSeconds());

        $time = $hours . ":" . $minutes . ":" . $seconds;

        return $time;
    }

    ///////////////////////////////////////////////
    //ACCESSORS                                  //
    ///////////////////////////////////////////////

    /**
     * @param mixed $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }

    /**
     * @return mixed
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @return mixed
     */
    public function getHours12Format()
    {
        return ($this->hours % 12);
    }

    /**
     * @param mixed $minutes
     */
    public function setMinutes($minutes)
    {
        $this->minutes = $minutes;
    }

    /**
     * @return mixed
     */
    public function getMinutes()
    {
        return $this->minutes;
    }

    /**
     * @param mixed $seconds
     */
    public function setSeconds($seconds)
    {
        $this->seconds = $seconds;
    }

    /**
     * @return mixed
     */
    public function getSeconds()
    {
        return $this->seconds;
    }
}