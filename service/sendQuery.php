<?php
header("Access-Control-Allow-Origin: *");
require_once($_SERVER['DOCUMENT_ROOT']."/service/Email.php"); 
$name = urlencode($_POST["name"]);
$email = urlencode($_POST["email"]);
$contact = urlencode($_POST["mobile"]);
$message = urlencode($_POST["message"]);



$sendMail = new Email();


    if(empty($name) || empty($email) || empty($contact) || empty($message)){
        echo "All fields are mandatory";
        die();
    }
    $sendMail->send($name, $email, $contact, $message);
    



?>