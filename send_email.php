<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $to = "snawaza243@gmail.com"; // Change this to your email address

    $subject = "New Message from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if (mail($to, $subject, $body)) {
        http_response_code(200);
        echo json_encode(array("message" => "Your message has been sent!"));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "There was a problem sending your message."));
    }
} else {
    http_response_code(403);
    // echo json_encode(array("message" => "Unauthorized access."));

    $elseMsa =  json_encode(array("message" => "Unauthorized access."));
}
