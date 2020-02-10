<?PHP
require_once($_SERVER['DOCUMENT_ROOT']."/service/DBSource.php"); 


class ClientDetails{
    
    function getClientDriveId($token){
        $driveId="";
        $projectId="";
        $dataSource = new DataSource();
        $conn = $dataSource->getConnection();
        $sql = "SELECT DRIVE_ID, PROJECT_ID from np_customer where TOKEN=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $stmt->bind_result($driveId, $projectId);
            $stmt->fetch();
            $stmt->close();
        }
        $dataSource->closeConnection($conn);
        $response = array('driveId' => $driveId,
                          'projectId' => $projectId
                    );
        return $response;
    }
}

?>