<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $to = "snawaza243@gmail.com"; // Enter your email address here
  $subject = "New Message from Contact Form";
  $body = "Name: $name\nEmail: $email\n\n$message";

  if (mail($to, $subject, $body)) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
} else {
  http_response_code(403);
}

error_log("Error sending email: " . error_get_last()['message']);

?>
