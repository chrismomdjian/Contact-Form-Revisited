<?php

// function validateDate($date) {
//   $date = explode('/', $date);
//
//   if(strlen($date[0]) != 2 // month
//     || strlen($date[1]) != 2 // day
//     || strlen($date[2]) != 4 // year
//     || !checkdate($date[0], $date[1], $date[2])
//   ) {
//     return false;
//   } else {
//     return true;
//   }
// }
//
// $my_date = "04/01/1994";
//
// if(validateDate($my_date)) {
//   echo "You entered a valid date.";
// } else {
//   echo "Invalid date.";
// }

if($_SERVER['REQUEST_METHOD'] == "POST") {
  if(empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['message'])) {
    $error_message = "Please fill out all fields in this form.";
  } else {
    $name = clean_fields($_POST['full_name']);
    $email = clean_fields(filter_var($_POST['email'], "FILTER_SANITIZE_EMAIL"));
    $message = clean_fields($_POST['message']);

    if(strlen($message) > 250) {
      $error_message = "Your message is too long! The limit is 250 characters.";
    }
  }
}

function clean_fields($data) {
  $data = htmlspecialchars($data);
  $data = stripslashes($data);
  $data = trim($data);

  // Clean data!
  return $data
}
