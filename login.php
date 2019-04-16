<?php

    function connection(){
        $servername = "localhost"; //127.0.0.1 equivalent IP server address
        $username = "root";
        $password = "";
        $dbname = "harbor"; 

        //Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        //Check connection
        if($conn->connect_error){
            die("Connection failed: ". $conn->connect_error);
        }else{
            //echo "Successfully connected!";
            return $conn;
        }
    }

    function login($username, $password){
        $conn = connection();
        $sql = "SELECT * FROM `employee` WHERE `emp_username` = '$username' AND `emp_password` = '$password' AND `emp_status` = 'A'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

   

?>