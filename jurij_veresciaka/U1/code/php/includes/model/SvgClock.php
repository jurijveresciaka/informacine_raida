<?php

class SvgClock
{

    ///////////////////////////////////////////////
    //VARIABLES                                  //
    ///////////////////////////////////////////////

    private $minutes_arrow_angle;
    private $hours_arrow_angle;

    private $minutes_arrow_length;
    private $hours_arrow_length;

    private $width;
    private $height;

    private $minute_tick_length;
    private $minute_tick_offset;

    private $hour_tick_length;
    private $hour_tick_offset;

    private $min_angle_arc_offset;
    private $max_angle_arc_offset;

    ///////////////////////////////////////////////
    //CONSTRUCTOR                                //
    ///////////////////////////////////////////////

    function __construct($minutes_arrow_angle, $hours_arrow_angle)
    {
        $this->minutes_arrow_angle = $minutes_arrow_angle;
        $this->hours_arrow_angle = $hours_arrow_angle;

        $this->minutes_arrow_length = 50;
        $this->hours_arrow_length = 30;

        $this->width = 200;
        $this->height = 200;
        $this->hour_tick_length = 20;
        $this->hour_tick_offset = 60;

        $this->minute_tick_length = 10;
        $this->minute_tick_offset = 70;

        $this->min_angle_arc_offset = 90;
        $this->max_angle_arc_offset = 95;
    }

    ///////////////////////////////////////////////
    //CUTSOM GETTERS                             //
    ///////////////////////////////////////////////

    public function getHtml()
    {
        $html = "";
        $html .= $this->getHeader();
        $html .= $this->getTicks(60, $this->minute_tick_offset, $this->minute_tick_length, "#000000");
        $html .= $this->getTicks(12, $this->hour_tick_offset, $this->hour_tick_length, "#000000");
        $html .= $this->getArrow($this->minutes_arrow_length, $this->minutes_arrow_angle, 6, "darkmagenta");
        $html .= $this->getArrow($this->hours_arrow_length, $this->hours_arrow_angle, 6, "darkblue");
        $html .= $this->getMinAngleArc(0, $this->min_angle_arc_offset, 2, "green");
        $html .= $this->getMinAngleArc(1, $this->max_angle_arc_offset, 2, "red");
        $html .= $this->getFooter();

        return $html;
    }

    private function getHeader()
    {
        $html = "";
        $html .= "      <svg width=\"" . $this->width . "\" height=\"" . $this->height . "\">" . "\n";

        return $html;
    }

    private function getFooter()
    {
        $html = "";
        $html .= "      </svg>" . "\n";

        return $html;
    }

    private function getArrow($length, $angle_degrees, $stroke_width, $color)
    {
        $x_1 = 0;
        $x_2 = 0;
        $y_1 = 0;
        $y_2 = 0;

        $angle_radians = deg2rad(($angle_degrees - 90));

        $html = "";

        $x_1 = ($this->width / 2);
        $y_1 = ($this->height / 2);
        $x_2 = ($length * cos($angle_radians)) + ($this->width / 2);
        $y_2 = ($length * sin($angle_radians)) + ($this->height / 2);

        $html .= $this->line($x_1, $y_1, $x_2, $y_2, $stroke_width, $color);

        return $html;
    }

    private function getTicks($number_of_ticks, $offset, $length, $color)
    {
        $x_1 = 0;
        $x_2 = 0;
        $y_1 = 0;
        $y_2 = 0;

        $html = "";

        $angle_radians = deg2rad(360.0 / $number_of_ticks);

        for ($i = 0; $i < $number_of_ticks; $i++) {
            $x_1 = $offset * cos($i * $angle_radians) + ($this->width / 2);
            $y_1 = $offset * sin($i * $angle_radians) + ($this->height / 2);
            $x_2 = ($offset + $length) * cos($i * $angle_radians) + ($this->width / 2);
            $y_2 = ($offset + $length) * sin($i * $angle_radians) + ($this->height / 2);

            $html .= $this->line($x_1, $y_1, $x_2, $y_2, 1, $color);
        }

        return $html;
    }

    private function getMinArrowAngle()
    {
        $angle = 0;

        if ($this->minutes_arrow_angle > $this->hours_arrow_angle) {
            $angle = $this->hours_arrow_angle;
        } else {
            $angle = $this->minutes_arrow_angle;
        }

        return $angle;
    }

    private function getMaxArrowAngle()
    {
        $angle = 0;

        if ($this->minutes_arrow_angle > $this->hours_arrow_angle) {
            $angle = $this->minutes_arrow_angle;
        } else {
            $angle = $this->hours_arrow_angle;
        }

        return $angle;
    }

    private function getMinAngleArc($large_arc_flag, $offset, $stroke_width, $stroke_color)
    {
        $min_angle_degrees = $this->getMinArrowAngle() - 90;
        $max_angle_degrees = $this->getMaxArrowAngle() - 90;

        $min_angle_radians = deg2rad($min_angle_degrees);
        $max_angle_radians = deg2rad($max_angle_degrees);

        $sweep_flag = 0;

        if (($min_angle_degrees + (360 - $max_angle_degrees)) < 180) {
            $sweep_flag = 0;
        } else {
            $sweep_flag = 1;
        }

        $x_1 = $offset * cos($min_angle_radians) + ($this->width / 2);
        $y_1 = $offset * sin($min_angle_radians) + ($this->height / 2);
        $x_2 = $offset * cos($max_angle_radians) + ($this->width / 2);
        $y_2 = $offset * sin($max_angle_radians) + ($this->height / 2);

        if ($large_arc_flag == 1) {
            $temp = $x_1;
            $x_1 = $x_2;
            $x_2 = $temp;

            $temp = $y_1;
            $y_1 = $y_2;
            $y_2 = $temp;
        }

        $html = "";
        $html .= $this->arc($x_1, $y_1, $offset, $offset, $large_arc_flag, $sweep_flag, $stroke_width, $stroke_color, $x_2, $y_2);

        return $html;
    }

    private function line($x_1, $y_1, $x_2, $y_2, $stroke_width, $stroke_color)
    {
        $html = "";
        $html .= "<line ";
        $html .= "x1=\"" . $x_1 . "\" ";
        $html .= "y1=\"" . $y_1 . "\" ";
        $html .= "x2=\"" . $x_2 . "\" ";
        $html .= "y2=\"" . $y_2 . "\" ";
        $html .= "stroke-width=\"" . $stroke_width . "\" ";
        $html .= "stroke=\"" . $stroke_color . "\" ";
        $html .= "stroke-linecap=\"round\" ";
        $html .= "/>" . "\n";

        return $html;
    }

    private function arc($x_1, $y_1, $rx, $ry, $large_arc_flag, $sweep_flag, $stroke_width, $stroke_color, $x_2, $y_2)
    {
        $html = "";
        $html .= "<path d=\"";
        $html .= "M " . $x_1 . " " . $y_1 . " A " . $rx . " " . $ry . " 0 " . $large_arc_flag . " " . $sweep_flag . " " . $x_2 . " " . $y_2 . "\"";
        $html .= "stroke-width=\"" . $stroke_width . "\" ";
        $html .= "stroke=\"" . $stroke_color . "\" ";
        $html .= "stroke-linecap=\"round\" ";
        $html .= "fill=\"none\" ";
        $html .= "/>" . "\n";

        return $html;
    }
}