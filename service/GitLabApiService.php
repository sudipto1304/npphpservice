<?php
require_once($_SERVER['DOCUMENT_ROOT']."/const/constant.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/service/DeliveryImageContent.php"); 

class GitLabApiService{
    
    static $accessToken = "";
    
    
    public function getContent($projectId){
        $this->getAccessToken(); 
        $deliveryImagesResponse = array();
        $deliveryImages = array();
        $_url = "https://gitlab.com/api/v4/projects/".$projectId."/repository/tree?per_page=500&access_token=".$this->accessToken;
        
        $opts = array('http' =>array(
                        'method'  => 'GET'
                        )
                    );
        $context  = stream_context_create($opts);
        $jsonStrig = @file_get_contents($_url, false, $context);
        $json = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $jsonStrig), true);
        for($i=0; $i<count($json); $i++){
            $deliveryImages[]=array('link' => "http://service.nils-photography.com/service/CustomerImage.php?image=".$json[$i]['path']."&id=".$projectId);
        }
        return json_encode($deliveryImages, JSON_UNESCAPED_SLASHES);
        
    }
    
    
    public function renderImage($projectId, $imagePath){
        $this->getAccessToken(); 
        $_url = "https://gitlab.com/api/v4/projects/".$projectId."/repository/files/".$imagePath."/raw?ref=master&access_token=".$this->accessToken;
        $opts = array('http' =>array(
                        'method'  => 'GET'
                        )
                    );
        $context  = stream_context_create($opts);
        return @file_get_contents($_url, false, $context);
    }
    
    private function getAccessToken(){
        $postdata = http_build_query(array(
                    'username' => GITLAB_USERID,
                    'password' => GITLAB_PASSWORD,
                    'grant_type' => 'password',
                )
            );
        
        $opts = array('http' =>array(
                        'method'  => 'POST',
                        'header'  => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => $postdata
                        )
                    );
        $context  = stream_context_create($opts);
            
        $jsonStrig = file_get_contents('https://gitlab.com/oauth/token', false, $context);
        $json = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $jsonStrig), true);
        $this->accessToken =  $json["access_token"];
    }
    
}



?>