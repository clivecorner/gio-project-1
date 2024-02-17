<?php

function convertDate($date)
{
    // // Validate the input date format
    // if (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $date)) {
    //     throw new Exception("Invalid date format. Please use the format of 01/04/2021.");
    // }

    // Split the date into day, month, and year
    list($month, $day, $year) = explode("/", $date);

    return date('M d, Y', mktime(0, 0, 0, $month, $day, $year));

}

$date = '07/04/2021';

echo convertDate($date);
