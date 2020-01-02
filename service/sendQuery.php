<?php
require_once($_SERVER['DOCUMENT_ROOT']."/service/Email.php"); 
$name = urlencode($_POST["name"]);
$email = urlencode($_POST["email"]);
$contact = urlencode($_POST["mobile"]);
$message = urlencode($_POST["message"]);

$sendMail = new Email();

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email Address";
    die();
}else{
    $sendMail->send($name, $email, $contact, $message);
    
}


?>