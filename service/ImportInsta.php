<?php
header("Access-Control-Allow-Origin: *");
require_once($_SERVER['DOCUMENT_ROOT']."/service/Post.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/const/constant.php"); 


$import = new ImportInstagramProfile();
echo $import->getInstagramPics();


//$a = new ImportInstagramProfile();

//$a->getInstagramPics();


class ImportInstagramProfile{

    public function getInstagramPics(){
        $response = array();
        $indexCount=0;
        $access_token = INSTA_TOKEN;
        $json_link = "https://api.instagram.com/v1/users/self/media/recent/?";
        $json_link .="access_token={$access_token}";
        $jsonStrig = file_get_contents($json_link);
        $json = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $jsonStrig), true);
        $jsonCount = count($json['data']);
        $number = array();
        for(;;){
            if($indexCount==6){
                break;
            }
            $rand = rand(0, $jsonCount-1);
            if(!in_array($rand, $number)){
                array_push($number, $rand);
                $likeCount = $json['data'][$rand]['likes']['count'];
                if (!isset($likeCount) || trim($likeCount) === ''){
                    $likeCount=0;
                }
                $instaPost = new Post($json['data'][$rand]['images']['low_resolution']['url'], $json['data'][$rand]['images']['low_resolution']['width'], $json['data'][$rand]['images']['low_resolution']['height'], $json['data'][$rand]['link'], $likeCount);
                array_push($response, $instaPost);
                $indexCount++;
            }else{
                continue;
            }
            
        }
        return json_encode($response);
    }

}

?>