<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
  $error_message = '';
  $isValid = true;

  if(empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['message'])) {
    $error_message = "Please fill out all fields in this form.";
    $isValid = false;
  } else {
    $name = clean_fields($_POST['full_name']);
    $email = clean_fields(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $message = clean_fields($_POST['message']);

    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
      $error_message = "Please enter a valid email address";
      $isValid = false;
    }

    if(strlen($message) > 250) {
      $error_message = "Your message is too long! The limit is 250 characters.";
      $isValid = false;
    }
  }

  $exploded_name = explode(" ", $name);
  $first_name = $exploded_name[0];
  $success_message = "Thanks, " . $first_name . "! Your form has been submitted.";
}

function clean_fields($data) {
  $data = htmlspecialchars($data);
  $data = stripslashes($data);
  $data = trim($data);
  return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Simple Contact Form</title>
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Custom stylesheet -->
  <link rel="stylesheet" href="form_style.css">
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>



<h1 id="form-title">Another Contact Form</h1>
<div class="container main">
  <?php
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    if($isValid) {
      echo '<div class="success-message">' . $success_message . '</div>';
    } else {
      echo '<div class="error-message">' . $error_message . '</div>';
    }
  }
  ?>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="main-form">
    <label for="full_name">Full Name</label><br>
    <input type="text" name="full_name" id="full_name" value="<?php if(!$isValid){echo $_POST['full_name'];} ?>"><br><br>

    <label for="email">Email</label><br>
    <input type="email" name="email" id="email" value="<?php if(!$isValid){echo $_POST['email'];} ?>"><br><br>

    <label for="message">Message</label><br>
    <textarea rows="5" id="message" name="message" placeholder="Max char count: 250"><?php if(!$isValid){echo $_POST['message'];} ?></textarea>

    <button type="submit" id="sub-btn">Submit</button>
  </form>
</div>

</body>
</html>
