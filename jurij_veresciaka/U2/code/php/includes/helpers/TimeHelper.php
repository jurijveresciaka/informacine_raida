<?php

class TimeHelper
{
    public function getNaktinisLaikas($date_start, $date_end, $night_start, $night_end)
    {
        ///////////////////////////////////////////////
        //CHECK TYPES                                //
        ///////////////////////////////////////////////

        if (!($date_start instanceof DateTime)
        ) {
            throw new Exception('date_start wrong parameter');
        }

        if (!($date_end instanceof DateTime)
        ) {
            throw new Exception('date_end wrong parameter');
        }

        if (!($night_start instanceof DateTime)
        ) {
            throw new Exception('night_start wrong parameter');
        }

        if (!($night_end instanceof DateTime)
        ) {
            throw new Exception('night_end wrong parameter');
        }

        ///////////////////////////////////////////////
        //CHECK VALUES                               //
        ///////////////////////////////////////////////

        if (!($date_start < $date_end)
        ) {
            throw new Exception('!(date_start < date_end)');
        }

        if (!($night_start < $night_end)
        ) {
            throw new Exception('!(night_start < night_end)');
        }

        ///////////////////////////////////////////////
        //LOGIC                                      //
        ///////////////////////////////////////////////

        $total_days = $date_start->diff($date_end)->days;

        $is_days_the_same = FALSE;
        if ($date_start->format('Y-m-d') == $date_end->format('Y-m-d')) {
            $is_days_the_same = TRUE;
        }

        $night_minutes = 0;

        if ($is_days_the_same) {
            $night_minutes += $this->getNightMinutesPerDay($date_start, $date_end, $night_start, $night_end);
        } else {
            $night_minutes += $this->getNightMinutesPerDay(
                $date_start,
                new DateTime($date_start->format('Y-m-d') . ' ' . '23:59:00'),
                $night_start,
                $night_end
            );
            $night_minutes += $this->getNightMinutesPerDay(
                new DateTime($date_end->format('Y-m-d') . ' ' . '00:00:00'),
                $date_end,
                $night_start,
                $night_end
            );

            $night_total = $this->getMinutesFromTime($night_end) - $this->getMinutesFromTime($night_start);

            if ($total_days > 0) {
                if ($this->getMinutesFromTime($date_end) >= $this->getMinutesFromTime($date_start)) {
                    $night_minutes += ($total_days - 1) * $night_total;
                } else {
                    $night_minutes += $total_days * $night_total;
                }
            }
        }

        return $night_minutes;
    }

    ///////////////////////////////////////////////
    //HELPERS                                    //
    ///////////////////////////////////////////////

    public function getNightMinutesPerDay($day_start, $day_end, $night_start, $night_end)
    {
        ///////////////////////////////////////////////
        //CHECK TYPES                                //
        ///////////////////////////////////////////////

        if (!($day_start instanceof DateTime)
        ) {
            throw new Exception('day_start wrong parameter');
        }

        if (!($day_end instanceof DateTime)
        ) {
            throw new Exception('day_end wrong parameter');
        }

        if (!($night_start instanceof DateTime)
        ) {
            throw new Exception('night_start wrong parameter');
        }

        if (!($night_end instanceof DateTime)
        ) {
            throw new Exception('night_end wrong parameter');
        }

        ///////////////////////////////////////////////
        //CHECK VALUES                               //
        ///////////////////////////////////////////////

        if (!($day_start <= $day_end)
        ) {
            throw new Exception('!(day_start <= day_end)');
        }

        if (!($night_start < $night_end)
        ) {
            throw new Exception('!(night_start < night_end)');
        }

        ///////////////////////////////////////////////
        //LOGIC                                      //
        ///////////////////////////////////////////////

        $day_start_minutes = $this->getMinutesFromTime($day_start);
        $day_end_minutes = $this->getMinutesFromTime($day_end);
        $night_start_minutes = $this->getMinutesFromTime($night_start);
        $night_end_minutes = $this->getMinutesFromTime($night_end);

        $day_total_minutes = $day_end_minutes - $day_start_minutes;
        $night_total_minutes = $night_end_minutes - $night_start_minutes;

        // day   /--/     ||      /--/
        // night     /--/ || /--/
        if (($day_end_minutes <= $night_start_minutes) || ($day_start_minutes >= $night_end_minutes)) {
            return 0;
        }
        // day   /-----/
        // night  /--/
        if (($day_start_minutes <= $night_start_minutes) && ($day_end_minutes >= $night_end_minutes)) {
            return $night_total_minutes;
        }
        // day     /--/
        // night /-----/
        if (($day_start_minutes >= $night_start_minutes) && ($day_end_minutes <= $night_end_minutes)) {
            return $day_total_minutes;
        }
        // day    /-----/    || /-----/
        // night     /-----/ || /--------/
        if (($day_start_minutes <= $night_start_minutes) && ($day_end_minutes < $night_end_minutes)) {
            return ($day_end_minutes - $night_start_minutes);
        }
        // day       /-----/ ||    /-----/
        // night  /-----/    || /--------/
        if (($day_start_minutes > $night_start_minutes) && ($day_end_minutes >= $night_end_minutes)) {
            return ($night_end_minutes - $day_start_minutes);
        }
    }

    public function getMinutesFromTime($time)
    {
        ///////////////////////////////////////////////
        //CHECK TYPES                                //
        ///////////////////////////////////////////////

        if (!($time instanceof DateTime)
        ) {
            throw new Exception('time wrong parameter');
        }

        ///////////////////////////////////////////////
        //LOGIC                                      //
        ///////////////////////////////////////////////

        $hours = (int)$time->format('H');
        $minutes = (int)$time->format('i');

        $minutes = $hours * 60 + $minutes;

        return $minutes;
    }
}