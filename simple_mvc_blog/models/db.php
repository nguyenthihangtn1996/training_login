<?php 
    class dbmodel{
        public function connect(){

            $servername = 'localhost';
            $username= 'root';
            $password ='';
            $dbname = "hang-wp";

            $conn = new mysqli($servername,$username,$password);
            mysqli_set_charset($conn, "utf8");

            
            if($conn->connect_error)
            {
                die("Connection Failed !" . $conn->connect_error()); 
            }
            else{
                    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
                    if($conn->query($sql)== TRUE )
                    {   
                        $conn = new mysqli($servername,$username,$password, $dbname);
                        $sql_t = "CREATE TABLE posts (id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255) NOT NULL, status VARCHAR(255), image VARCHAR(255), description VARCHAR(255), create_at DATETIME, updated_at DATETIME )";
                        $conn->query($sql_t);
                    }else{
                        $conn = new mysqli($servername,$username,$password, $dbname);
                    }
            }


            return $conn;
        }
    }
    
?>