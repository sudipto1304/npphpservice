<?php
header("Access-Control-Allow-Origin: *");
require_once($_SERVER['DOCUMENT_ROOT']."/service/Email.php"); 
$name = ($_POST["name"]);
$email = ($_POST["email"]);
$contact = urlencode($_POST["mobile"]);
$message = urlencode($_POST["message"]);
$response = '[]';


$sendMail = new Email();


    if(empty($name) || empty($email) || empty($contact) || empty($message)){
        $response='[{"message" : "All fields are mandatory"}]' ;
        echo json_decode($response);
        die();
    }
    $response='[{"message" : $sendMail->send($name, $email, $contact, $message)}]' ;
    echo json_decode($response);
    



?>