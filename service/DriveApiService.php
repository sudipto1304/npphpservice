<?php

class DriveApiManager{
    
    public function getContent(){
        $this->getAccessToken();
    }
    
    
    private function getAccessToken(){
        $postdata = http_build_query(array(
                    'client_id' => '30181947658-uc1fpdhbg38p8i4qmakq35tnfbma0hnk.apps.googleusercontent.com',
                    'client_secret' => 'VfftJJFj8fvKBbAYjQn7u3TL',
                    'refresh_token' => '1//0fl-jCsn1POJlCgYIARAAGA8SNwF-L9IrSwhWQjhWxUrmS2viVTtQQnWtSGqaDhXxQhXdmyRbhiZifmL6Xg44vji38WpChmIp7Sc',
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
        var_dump($json);
    }
    
}



?>