<?php 
    function getConnection(){
        $host = 'localhost';
        $user = 'root';
        $pw = 'Yuiop098';
        $db = 'crud_native';
    
        $conn = new mysqli($host, $user, $pw, $db);
    
        if($conn->connect_error){
            die('Connection Failed:' . $conn->connect_error);
        }
    
        return $conn;
    }
?>