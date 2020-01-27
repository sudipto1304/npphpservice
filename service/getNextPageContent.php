<?php
header("Access-Control-Allow-Origin: *");
require_once($_SERVER['DOCUMENT_ROOT']."/service/DriveApiService.php"); 

$drive = new DriveApiManager();
echo $drive->getNextPageContent($_POST["link"]);

?>