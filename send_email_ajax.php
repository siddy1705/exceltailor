<?php
require_once './config/config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$message = 'Name: ' . $name . '\r\nSubject: ' . $subject . '\r\n\r\nMessage: ' . $message;

$email = mail('vitthaldas.siddharth@gmail.com', $subject, $message);

echo json_encode($email);