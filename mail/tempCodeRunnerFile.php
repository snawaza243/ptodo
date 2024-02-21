<?php
$to      = 'shahnawaz_11202722@mmumullana.org';
$subject = 'Subject';
$message = 'Hello!';
$headers = 'From: snawaza243@gmail.com' . "\r\n" .
    'Reply-To: snawaza243@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully!';
} else {
    echo 'Failed to send email.';
}


?>