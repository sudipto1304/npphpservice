<?php
require_once($_SERVER['DOCUMENT_ROOT']."/service/ImageContent.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/service/constant.php"); 


class LoadContent{

    public function getImages(){

        


        $response = array();
        $json_link = HOST."/dashboard/getContent";

        $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $json_link);

    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

    $content = curl_exec ($ch);

    curl_close ($ch); 

    echo $content;
        
    }

}

?>