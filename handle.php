<?php

function validateDate($date) {
  $date = explode('/', $date);

  if(strlen($date[0]) != 2 // month
    || strlen($date[1]) != 2 // day
    || strlen($date[2]) != 4 // year
    || !checkdate($date[0], $date[1], $date[2])
  ) {
    return false;
  } else {
    return true;
  }
}

$my_date = "04/01/1994";

if(validateDate($my_date)) {
  echo "You entered a valid date.";
} else {
  echo "Invalid date.";
}
