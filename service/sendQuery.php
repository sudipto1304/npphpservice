<?php
require_once($_SERVER['DOCUMENT_ROOT']."/service/Email.php"); 
$name = $_POST["name"];
$email = $_POST["email"];
$contact = $_POST["mobile"];
$message = $_POST["message"];

$sendMail = new Email();

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email Address";
    die();
}else{
    $sendMail->send($name, $email, $contact, $message);
    
}


?>