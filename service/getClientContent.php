<?php
header("Access-Control-Allow-Origin: *");
require_once($_SERVER['DOCUMENT_ROOT']."/service/DriveApiService.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/service/GitLabApiService.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/service/ClientDetails.php"); 

$customerToken = $_GET["CID"];

if(isset($customerToken)){
    //$drive = new DriveApiManager();
    $gitlab = new GitLabApiService();
    $clientDetails = new ClientDetails();
    $response = $clientDetails->getClientDriveId($customerToken);
    //echo $drive->getContent($response['driveId']);
    echo $gitlab->getContent($response['projectId']);
}else{
    die("Invalid CID");
}


?>