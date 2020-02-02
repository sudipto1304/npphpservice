<?PHP
require_once($_SERVER['DOCUMENT_ROOT']."/const/constant.php"); 


class DataSource{
    function getConnection(){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB) or die("Connect failed: %s\n". $conn -> error);
        return $conn;
    }

    function closeConnection($conn){
        $conn->close();
    }

}

?>