<?php
    class db {

        private $host = "localhost";
        private $dbname = "db_ecommerce";
        private $user = "root";
        private $password = "";

        public function connection() {
            try {
                $PDO = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
                return $PDO;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
    }
?>