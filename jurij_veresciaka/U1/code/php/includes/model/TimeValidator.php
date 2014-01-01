<?php

class TimeValidator
{

    ///////////////////////////////////////////////
    //VARIABLES                                  //
    ///////////////////////////////////////////////

    private $regex;

    ///////////////////////////////////////////////
    //VALIDATOR                                  //
    ///////////////////////////////////////////////

    public function isTimeValid($time)
    {
        $is_valid = FALSE;

        if (preg_match('/^' . $this->regex . '$/', $time)) {
            $is_valid = TRUE;
        } else {
            $is_valid = FALSE;
        }

        return $is_valid;
    }

    ///////////////////////////////////////////////
    //CONSTRUCTOR                                //
    ///////////////////////////////////////////////

    function __construct()
    {
        $this->regex = "([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]";
    }

    ///////////////////////////////////////////////
    //ACCESSORS                                  //
    ///////////////////////////////////////////////

    /**
     * @return mixed
     */
    public function getRegex()
    {
        return $this->regex;
    }
}