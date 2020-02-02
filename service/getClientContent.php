<?php
header("Access-Control-Allow-Origin: *");
require_once($_SERVER['DOCUMENT_ROOT']."/service/DriveApiService.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/service/ClientDetails.php"); 

$customerToken = $_GET["CID"];

if(isset($customerToken)){
    $drive = new DriveApiManager();
    $clientDetails = new ClientDetails();
    $driveId = $clientDetails->getClientDriveId($customerToken);
    echo $drive->getContent($driveId);
}else{
    die("Invalid CID");
}


?>