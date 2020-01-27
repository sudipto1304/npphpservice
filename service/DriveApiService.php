<?php
require_once($_SERVER['DOCUMENT_ROOT']."/const/constant.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/service/DeliveryImageContent.php"); 

class DriveApiManager{
    
    static $accessToken = "";
    
    
    public function getContent(){
        //$this->getAccessToken();
        $deliveryImages = array();
        $_url = "https://www.googleapis.com/drive/v2/files/"."0B_ioEFehPeW5amVGYXYxUlpZbVU"."/children?access_token=".$this->accessToken;
        $opts = array('http' =>array(
                        'method'  => 'GET'
                        )
                    );
        $context  = stream_context_create($opts);
        $jsonStrig = @file_get_contents($_url, false, $context);
        echo $jsonStrig;
        if(!$jsonStrig){
            $this->getAccessToken();
            $_url = "https://www.googleapis.com/drive/v2/files/"."0B_ioEFehPeW5amVGYXYxUlpZbVU"."/children?access_token=".$this->accessToken;
            $jsonStrig = @file_get_contents($_url, false, $context);
        }
        
        $json = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $jsonStrig), true);
        for($i=0; $i<count($json['items']); $i++){
            $deliveryImage = new DeliveryImage();
            $deliveryImage->setViewLink("https://drive.google.com/file/d/".$json['items'][$i]['id']."/view");
            $deliveryImages[
                'link' =>$deliveryImage
            ]'
   '     }
        return json_encode($deliveryImages, JSON_UNESCAPED_SLASHES);
    }
    
    
    private function getAccessToken(){
        $postdata = http_build_query(array(
                    'client_id' => CLINET_ID,
                    'client_secret' => CLIENT_SECRET,
                    'refresh_token' => REFRESH_TOKEN,
                    'grant_type' => 'refresh_token',
                )
            );
        
        $opts = array('http' =>array(
                        'method'  => 'POST',
                        'header'  => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => $postdata
                        )
                    );
        $context  = stream_context_create($opts);
            
        $jsonStrig = file_get_contents('https://www.googleapis.com/oauth2/v4/token', false, $context);
        $json = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $jsonStrig), true);
        $this->accessToken =  $json["access_token"];
    }
    
}



?>