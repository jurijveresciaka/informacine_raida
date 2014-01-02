<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "HtmlHelper.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "Clock.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "AngleCalculator.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "TimeValidator.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "SvgClock.php";

$html_helper = new HtmlHelper();

echo $html_helper->getHeader();
echo $html_helper->getMenu();
echo $html_helper->getDescription();
echo $html_helper->getTimeForm();

if (isset($_POST['time'])) {
    $time_validator = new TimeValidator();

    if ($time_validator->isValid($_POST['time'])) {
        $clock = new Clock($_POST['time']);

        $angle_calculator = new AngleCalculator($clock);
        echo $html_helper->getResult($clock->getTime(), $angle_calculator->getMinimumAngleBetweenClockArrowsString(), $angle_calculator->getMaximumAngleBetweenClockArrowsString());

        $svg_clock = new SvgClock($angle_calculator->getMinutesArrowAngle(), $angle_calculator->getHoursArrowAngle());
        echo $html_helper->getSvgClock($svg_clock->getHtml());
    }
}

echo $html_helper->getFooter();