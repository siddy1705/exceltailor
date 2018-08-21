<?php
require_once './config/config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$message = "Name: " . $name . "\r\nSubject: " . $subject . "\r\n\r\nMessage: " . $message;

$headers = "From: Excel Tailor Contact Form <contactform@exceltailor.com>\r\n";

$email = mail('info@exceltailor.com', $subject, $message, $headers);

echo json_encode($email);