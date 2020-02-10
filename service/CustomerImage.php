<?PHP
header("Access-Control-Allow-Origin: *");
require_once($_SERVER['DOCUMENT_ROOT']."/service/GitLabApiService.php"); 

$imagePath = $_GET["image"];
$projectId = $_GET["id"];

$gitlab = new GitLabApiService();

header('Content-type: image/jpeg');
echo $gitlab->renderImage($projectId, $imagePath);


?>