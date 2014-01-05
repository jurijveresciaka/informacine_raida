<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "TimeHelper.php";

$time_helper = new TimeHelper();

echo $time_helper->getNaktinisLaikas(
    new DateTime('2013-12-01 23:59:00'),
    new DateTime('2013-12-02 00:01:00'),
    new DateTime('00:00:00'),
    new DateTime('00:04:00')
);

