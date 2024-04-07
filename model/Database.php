<?php
    class Database{
        private  $server = "localhost";
        private $username = "root";
        private $password = "";
        private $db = "ams";
        private $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db",$this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $err){
                echo $err->getMessage();
            }
            return $this->conn;
        }

    }

?>